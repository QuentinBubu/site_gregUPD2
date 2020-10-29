<?php

namespace App;

use Exception;

require_once 'Database.php';

class User extends Database
{
    private $informations;

    private function setConnexion(string $userName, string $password)
    {
        $tempData = $this->request(
            'SELECT *
            FROM `users`
            WHERE `userName` = :userName',
            [
                'userName' => $userName
            ],
            'fetch'
        );

        if (empty($tempData)) {
            throw new Exception('Aucun compte trouvé');
        }

        if (password_verify($password, $tempData['password'])) {
            $this->informations = $tempData;
            $_SESSION['id'] = $this->informations['id'];
        } else {
            throw new Exception('Mot de passe incorrect');
        }
    }

    private function setConnexionById(int $id)
    {
        $this->informations = $this->request(
            'SELECT *
            FROM `users`
            WHERE `id` = :id',
            [
                'id' => $id
            ],
            'fetch'
        );
    }

    private function setUploadAds($file)
    {
        if (!isset($_POST['categorie'], $_POST['description'], $_POST['details'], $_POST['title'])) {
            throw new Exception('Erreur: Veuillez remplir tout les champs!');
        }

        ini_set('upload_max_filesize', '11M');
        ini_set('post_max_size', '11M');

        $dossier = "./assets/picture/pub/";
        $fichier = basename($file['image']['name']);
        $taille_maxi = 100000000;
        $taille = filesize($file['image']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.ico');
        $extension = strtolower(strrchr($file['image']['name'], '.'));

        if (!in_array($extension, $extensions)) {
            throw new Exception('Erreur: Vous pouvez uploader un fichier de format png, gif, jpg, jpeg, ico');
        } elseif ($taille > $taille_maxi) {
            throw new Exception('Erreur: Le fichier est trop volumineux...');
        } else {
            $fichier = "IMG" . sha1(session_id() . microtime()) . $extension;
            if (!move_uploaded_file($file['image']['tmp_name'], $dossier . $fichier)) {
                throw new Exception("Erreur: Échec lors de l'upload");
            }
        }

        $this->request(
            'INSERT INTO `advertisement`
            (`description`,
            `details`,
            `image`,
            `categorie`,
            `title`)
            VALUES(
                :dsc,
                :details,
                :img,
                :categorie,
                :title
            )',
            [
                'dsc' => $_POST['description'],
                'details' => $_POST['details'],
                'img' => $dossier . $fichier,
                'categorie' => $_POST['categorie'],
                'title' => $_POST['title']
            ]
            );
    }

    private function setReplaceImage($file)
    {
        if (!isset($_POST['diapo'])) {
            throw new Exception('Erreur: Veuillez saisir tout les champs!');
        }

        ini_set('upload_max_filesize', '11M');
        ini_set('post_max_size', '11M');

        $dossier = "./assets/picture/diapo/";
        $fichier = basename($file['imageDiapo']['name']);
        $taille_maxi = 100000000;
        $taille = filesize($file['imageDiapo']['tmp_name']);
        $extension = strtolower(strrchr($file['imageDiapo']['name'], '.'));

        if ($extension !== '.png') {
            throw new Exception('Erreur: Vous pouvez uploader un fichier de format png uniquement!');
        } elseif ($taille > $taille_maxi) {
            throw new Exception('Erreur: Le fichier est trop volumineux...');
        } else {
            $fichier = $_POST['diapo'] .  '.png';
            if (!move_uploaded_file($file['imageDiapo']['tmp_name'], $dossier . $fichier)) {
                throw new Exception("Erreur: Échec lors de l'upload");
            }
        }
    }

    private function setNewUser()
    {
        if (!isset($_POST['newUserId'], $_POST['newUserMail'], $_POST['newUserPswd'], $_POST['newUserPswdConfirm'])) {
            throw new Exception('Erreur: Veuillez saisir tous les champs!');
        }

        $this->passwordVerify($_POST['newUserPswd'], $_POST['newUserPswdConfirm']);

        if (!filter_var($_POST['newUserMail'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Erreur: Veuillez saisir une adresse mail valide!');
        }

        $this->request(
            'INSERT INTO `users` (
                `userName`,
                `password`,
                `mail`,
                `accountType`
            ) VALUES (
                :userName,
                :pswd,
                :mail,
                :accountType
            )',
            [
                'userName' => $_POST['newUserId'],
                'pswd' => password_hash($_POST['newUserPswd'], PASSWORD_ARGON2ID),
                'mail' => $_POST['newUserMail'],
                'accountType' => $_POST['newUserSA'] ?? 'admin'
            ]
        );
    }

    private function setUpdatePassword(string $password, string $passwordConfirm, string $token)
    {
        password_verify($password, $passwordConfirm);

        $this->request(
            'UPDATE `users`
            SET `password` = :pass
            WHERE `token` = :token',
            [
                'pass' => password_hash($password, PASSWORD_ARGON2ID),
                'token' => $token
            ]
        );

        $this->request(
            'UPDATE `users`
            SET `token` = null'
        );
    }

    private function passwordVerify(string $password, string $passwordConfirm) : bool
    {
        if ($password !== $passwordConfirm) {
            throw new Exception('Erreur: Les mots de passes ne correspondent pas!');
        }

        if(strlen($password) < 10 ) {
            throw new Exception('Erreur: Veuillez saisir un mot de passe avec plus de 10 caractères!');
        }
        
        return True;
    }

    public function getConnexion($userName, $password)
    {
        $this->setConnexion($userName, $password);
    }

    public function getConnexionById($id)
    {
        $this->setConnexionById($id);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
    }

    public function getUploadAds($file)
    {
        return $this->setUploadAds($file);
    }

    public function getUploadDiapo($file)
    {
        return $this->setReplaceImage($file);
    }

    public function getNewUser()
    {
        $this->setNewUser();
    }

    public function getAccountType()
    {
        return $this->informations['accountType'];
    }

    public function getUpdatePassword(string $password, string $passwordConfirm, string $token)
    {
        $this->setUpdatePassword($password, $passwordConfirm, $token);
    }
}
