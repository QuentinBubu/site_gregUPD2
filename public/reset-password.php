<?php

use App\User;

$user = new User();

if (!isset($_GET['token'])) {
    header('Location: /');
    exit();
}

if ($_GET['token'] == 'null') {
    header('Location: /');
    exit();
}

$userExist = $user->request(
    'SELECT COUNT(*)
    FROM `users`
    WHERE `token` = :token',
    [
        'token' => $_GET['token']
    ],
    'fetch'
);

if ($userExist[0] == 0) {
    header('Location: /');
    exit();
}

?>

<form method="post">
    <label>
        <input type="password" name="password1">
    </label>
    <label>
        <input type="password" name="password2">
    </label>
    <button>Enregistrer</button>
</form>