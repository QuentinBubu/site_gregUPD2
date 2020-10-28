<?php

use App\User;

$user = new User;

$token = bin2hex(random_bytes(random_int(15, 50)));

$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$header .= "From: support@site_greg.com\r\n";
$message = "<h1>Support</h1>
            <h3>Mot de passe oublié?</h3>
            Voici votre lien pour réinitialiser votre mot de passe:
            <a href=\"localhost:3000/password?token={$token}\">ici</a> ou copiez collez ce lien: localhost:3000/password?token={$token}";

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