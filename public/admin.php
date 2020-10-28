<?php

use App\User;

$user = new User;

if (!isset($_SESSION['id'])) {
    if (
        !isset($_POST['id'])
        || empty($_POST['id'])
        && empty($_POST['pswd'])
        && empty($_POST['mail'])
    ) {
        die('<a href="/">Veuillez vous connecter!</a>');
    }

    try{
        $user->getConnexion($_POST['id'], $_POST['pswd']);
    } catch (Exception $e) {
        echo 'Erreur: ' . $e->getMessage();
        die('<br><a href="/">Retour</a>');
    }
} else {
    $user->getConnexionById($_SESSION['id']);
}

if (isset($_POST['details'])) {
    try{
        $user->getUploadAds($_FILES);
        header('Location: /espace-admin');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} elseif (isset($_POST['deleteAds'])) {
    unlink($user->request(
        'SELECT `image`
        FROM `advertisement`
        WHERE `id` = :id',
        [
            'id' => $_POST['deleteAds']
        ],
        'fetch'
    )[0]);

    $user->request(
        'DELETE FROM `advertisement`
        WHERE `id` = :id',
        [
            'id' => $_POST['deleteAds']
        ]
    );
    header('Location: /espace-admin');
} elseif (isset($_POST['newUserId'])) {
    try {
        $user->getNewUser();
        header('Location: /espace-admin');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} elseif (isset($_POST['deleteUser'])) {
    $user->request(
        'DELETE FROM `users`
        WHERE `id` = :id',
        [
            'id' => $_POST['deleteUser']
        ]
    );
    header('Location: /espace-admin');
} elseif (isset($_POST['diapo'])) {
    try{
        $user->getUploadDiapo($_FILES);
    } catch (Exception $e) {
         echo $e->getMessage();
    }
}

$listUser = $user->request(
    'SELECT `id`, `userName`
    FROM `users`',
    [],
    'fetchAll'
);

$listAds = $user->request(
    'SELECT `id`, `title`
    FROM `advertisement`',
    [],
    'fetchAll'
);

?>
    <main id="admin">
        <section>
            <h3>Ajouter une annonce</h3>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Titre" required />
                <input type="file" name="image" title="Choisissez une image" placeholder="Image" accept="image/*" required />
                <textarea name="description" cols="30" rows="10" placeholder="Description" required ></textarea>
                <textarea name="details" cols="30" rows="10" placeholder="Détails" required ></textarea>
                <select name="categorie">
                    <option value="1">Portails</option>
                    <option value="2">Chaises</option>
                    <option value="3">Tables</option>
                    <option value="4">Divers</option>
                </select>
                <button type="reset">Effacer</button>
                <button>Enregistrer</button>
            </form>
        </section>
        <section>
            <h3>Supprimer une annonce</h3>
            <form method="post">
                <select name="deleteAds">
                    <option selected disabled>-SÉLECTIONNEZ UNE ANNONCE-</option>
                    <?php foreach ($listAds as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button>Supprimer</button>
            </form>
        </section>
        <section>
            <h3>Diaporama</h3>
            <p>Veuillez importer une image en .png</p>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="imageDiapo" title="Choisissez une image" placeholder="Image" accept="image/png" required />
                <section>
                    <p>Choisissez une image à remplacer:</p>
                    <span>
                        <label>Diapo 1</label>
                        <input type="radio" value="diapo1" name="diapo" />
                    </span>
                    <span>
                        <label>Diapo 2</label>
                        <input type="radio" value="diapo2" name="diapo" />
                    </span>
                    <span>
                        <label>Diapo 3</label>
                        <input type="radio" value="diapo3" name="diapo" />
                    </span>
                    <span>
                        <label>Diapo 4</label>
                        <input type="radio" value="diapo4" name="diapo" />
                    </span>
                    <span>
                        <label>Diapo 5</label>
                        <input type="radio" value="diapo5" name="diapo" />
                    </span>
                    <span>
                        <label>Diapo 6</label>
                        <input type="radio" value="diapo6" name="diapo" />
                    </span>
                </section>
                <button>Enregistrer</button>
            </form>
        </section>
        <section></section>
        <?php if ($user->getAccountType() === 'superAdmin'): ?>
        <section>
            <h3>Ajouter un administrateur</h3>
            <form method="post">
                <input type="text" name="newUserId" placeholder="Nom d'utilisateur" required />
                <input type="email" name="newUserMail" placeholder="Email" required>
                <input type="password" name="newUserPswd" placeholder="Mot de passe temporaire" required />
                <input type="password" name="newUserPswdConfirm" placeholder="Confirmez le mot de passe" required />
                <label for="newUserSA">Super Administrateur: </label>
                <input type="checkbox" value="superAdmin" name="newUserSA" id="newUserSA"/>
                <button type="reset">Effacer</button>
                <button>Enregistrer</button>
            </form>
        </section>
        <section>
            <h3>Supprimer un administrateur</h3>
            <form method="post">
                <select name="deleteUser">
                    <option value="" selected disabled>-CHOISISSEZ UN UTILISATEUR-</option>
                    <?php foreach ($listUser as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['userName'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button>Valider</button>
            </form>
        </section>
        <section>
            <a href="/">Retour</a>
        </section>
        <section>
            <a href="/logout">Se déconnecter</a>
        </section>
    </main>
</body>
</html>
<?php endif; ?>