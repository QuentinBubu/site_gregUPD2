<?php

use App\Database;

$database = new Database;

$categorieOne = $database->request(
    'SELECT *
    FROM `advertisement`
    WHERE `categorie` = 1',
    [],
    'fetchAll'
);

$categorieTwo = $database->request(
    'SELECT *
    FROM `advertisement`
    WHERE `categorie` = 2',
    [],
    'fetchAll'
);

$categorieThree = $database->request(
    'SELECT *
    FROM `advertisement`
    WHERE `categorie` = 3',
    [],
    'fetchAll'
);

$categorieFour = $database->request(
    'SELECT *
    FROM `advertisement`
    WHERE `categorie` = 4',
    [],
    'fetchAll'
);

?>
        <header class="top_bar">
            <div id="phone_menu">
                <img src="assets/picture/system/others/icon-menu.svg" alt="Menu" />
            </div>
            <nav id="top-bar-nav">
                <ul>
                    <li id="shownBreakPoints">Catégories
                        <nav id="breakPoints">
                            <ul>
                                <li><a href="#Portails">Portails</a></li>
                                <li><a href="#Tables">Tables&nbsp;&nbsp;</a></li>
                                <li><a href="#Chaises">Chaises</a></li>
                                <li><a href="#Divers">Divers&nbsp;&nbsp;</a></li>
                            </ul>
                        </nav>
                    </li>
                    <li>Mon super site!</li>
                    <li><a href="#contact">Me contacter</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section id="me">
                <div>
                    Bonjour,<br />
                    Je suis autoentrepreneur et aime mon travail<br />
                    Vous pouvez me demander des services sur mesures<br />
                    Vous trouverez ci dessous quelques une de mes créations<br />
                    Vous pourrez également appuyer sur le bouton "lancer la diapositive" pour avoir une diapositive de mes créations!
                </div>
            </section>
            <hr />
            <section>
                <span id="Portails">Portails:</span>
                <?php foreach ($categorieOne as $arrays): ?>
                    <article class="annonces">
                        <div>
                            <p><img src="<?= $arrays['image'] ?>" alt="Erreur lors du chargement de l'image"></p>
                            <div>
                                <h2><?= $arrays['title'] ?></h2>
                                <p><?= nl2br($arrays['description']) ?></p>
                            </div>
                            <p><?= nl2br($arrays['details']) ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
                <span id="Tables">Tables:</span>
                <?php foreach ($categorieTwo as $arrays): ?>
                    <article class="annonces">
                        <div>
                            <p><img src="<?= $arrays['image'] ?>" alt="Erreur lors du chargement de l'image"></p>
                            <div>
                                <h2><?= nl2br($arrays['title']) ?></h2>
                                <p><?= nl2br($arrays['description']) ?></p>
                            </div>
                            <p><?= $arrays['details'] ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
                <span id="Chaises">Chaises:</span>
                <?php foreach ($categorieThree as $arrays): ?>
                    <article class="annonces">
                        <div>
                            <p><img src="<?= $arrays['image'] ?>" alt="Erreur lors du chargement de l'image"></p>
                            <div>
                                <h2><?= nl2br($arrays['title']) ?></h2>
                                <p><?= nl2br($arrays['description']) ?></p>
                            </div>
                            <p><?= $arrays['details'] ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
                <span id="Divers">Divers:</span>
                <?php foreach ($categorieFour as $arrays): ?>
                    <article class="annonces">
                        <div>
                            <p><img src="<?= $arrays['image'] ?>" alt="Erreur lors du chargement de l'image"></p>
                            <div>
                                <h2><?= nl2br($arrays['title']) ?></h2>
                                <p><?= nl2br($arrays['description']) ?></p>
                            </div>
                            <p><?= $arrays['details'] ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
            <hr />
            <section id="contact">
                <article>
                    <h2>Me contacter/Me trouver</h2>
                    <p>Pour me contacter par mail: <a href="mailto:contact@example.com">contatct@example.com</a></p>
                    <p>Pour me contacter par télephone: <a href="tel:+33612345678">+33612345678</a></p>
                    <p>Mon adresse: Avenue des Champs-Élysées, Paris</p>
                    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.392419294328!2d2.305631715629927!3d48.869795279288574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fc4f8007851%3A0x5aa1a787f38f64f6!2sAv.%20des%20Champs-%C3%89lys%C3%A9es%2C%2075008%20Paris!5e0!3m2!1sfr!2sfr!4v1597225903405!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
                </article>
            </section>
            <hr />
            <section id="admin-space">
                <img src="assets/picture/system/others/administrator.png" alt="Administrateur image" />
                <h1>Espace Administrateur</h1>
                <div>
                    <form action="espace-admin" method="post">
                        <input type="text" placeholder="Votre Identifiant" name="id" />
                        <br />
                        <input type="password" placeholder="Votre mot de passe" name="pswd" id="pswd" />
                        <br />
                        <button>Se connecter</button>
                        <br />
                        <button type="reset">Supprimer</button>
                        <br />
                    </form>
                </div>
                <div>
                    <h2>Mot de passe oublié?</h2>
                    <form action="password-forget" method="post">
                        <input type="email" name="mail" placeholder="Votre email" />
                        <br />
                        <button>Envoyer un mail</button>
                    </form>
                </div>
            </section>
        </main>
        <section id="diapo">
            <article class="cadre-diapo">
                <img
                    class="diapo"
                    src="./assets/picture/diapo/diapo1.png"
                    alt="Image 1 de la diapositive"
                />
                <img
                    class="diapo"
                    src="./assets/picture/diapo/diapo2.png"
                    alt="Image 2 de la diapositive"
                />
                <img
                    class="diapo"
                    src="./assets/picture/diapo/diapo3.png"
                    alt="Image 3 de la diapositive"
                />
                <img
                    class="diapo"
                    src="./assets/picture/diapo/diapo4.png"
                    alt="Image 4 de la diapositive"
                />
                <img
                    class="diapo"
                    src="./assets/picture/diapo/diapo5.png"
                    alt="Image 5 de la diapositive"
                />
                <img
                    class="diapo"
                    src="./assets/picture/diapo/diapo6.png"
                    alt="Image 6 de la diapositive"
                />
                <button class="precedent" aria-label="précédent" onclick="boutons(-1)">&#10094;</button>
                <button class="suivant" aria-label="suivant" onclick="boutons(1)">&#10095;</button>
                <div class="cadre-number">
                <button class="number">1</button>
                <button class="number">2</button>
                <button class="number">3</button>
                <button class="number">4</button>
                <button class="number">5</button>
                <button class="number">6</button>
            </div>
            <span id="enter">Appuyer sur "Entrée" pour fermer</span>
            <span id="cross">X</span>
            </article>
        </section>
    <div style="margin-top: 500px;">end file</div>
</body>

</html>