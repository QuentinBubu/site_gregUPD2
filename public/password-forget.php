<?php
session_start();

use App\User;

$user = new User;

if (isset($_POST['mail'])) {
    $selectUser = $user->request([
        'SELECT `user`
        FROM `users`
        WHERE `mail` = :mail',
        [
            'mail' => $_POST['mail']
        ],
        'fetch'
    ]);
    if (!empty($selectUser)) {
        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header .= "From: support@site_greg.com\r\n";
        mail();
    }
}