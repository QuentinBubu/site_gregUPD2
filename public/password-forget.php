<?php

use App\User;

$user = new User;

$token = bin2hex(random_bytes(random_int(15, 50)));

$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=ISO-8859' . "\r\n";
$header .= "From: support@site_greg.com\r\n";
$message = '<html><head>';
$message .= '<meta charset="utf-8" />';
$message .= '<title>Support - réinitialiser votre mot de passe</title>';
$message .= '</head><body>';
$message .= '<h1>Support - site greg</h1>';
$message .= '<h3>Mot de passe oublié?</h3>';
$message .= '<p>Vous avez demander à réinitialiser votre mot de passe?</p>';
$message .= '<p>Voici votre lien pour le réinitialiser: <br />';
$message .= '<a href="localhost:3000/password?token=' . $token . '">En cliquant ici</a><br /> ou copiez collez ce lien:<br />localhost:3000/password?token=' . $token . '</p>';
$message .= '</body></html>';

if (isset($_POST['mail'])) {
    $selectUser = $user->request(
        'SELECT COUNT(*)
        FROM `users`
        WHERE `mail` = :mail',
        [
            'mail' => $_POST['mail']
        ],
        'fetch'
    );
    if ($selectUser[0] != 0) {
        $user->request(
            'UPDATE `users`
            SET `token` = :token
            WHERE `mail` = :mail',
            [
                'token' => $token,
                'mail' => $_POST['mail']
            ]
        );
        mail($_POST['mail'], 'Support site greg - Réinitialisation mot de passe', $message, $header);
        header('Location: /');
        exit();
    } else {
        echo 'Mail introuvable, cliquez <a href="/">ici</a>';
    }
}