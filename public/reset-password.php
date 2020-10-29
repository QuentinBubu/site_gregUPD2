<?php

use App\User;

$user = new User();

if (isset($_POST['password'], $_POST['passwordConfirm'])) {
    try {
        $user->getUpdatePassword(
            $_POST['password'],
            $_POST['passwordConfirm'],
            $_POST['token']
        );
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

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

<form method="post" action="reset-password">
    <label>
        <input type="password" name="password">
    </label>
    <label>
        <input type="password" name="passwordConfirm">
    </label>
    <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
    <button>Enregistrer</button>
</form>