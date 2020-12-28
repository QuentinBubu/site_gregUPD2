<?php

use App\Database;

$database = new Database();

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
                    <li>SGMC 26</li>
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
                    <h2>Me contacter / Me trouver</h2>
                    <p>Pour me contacter par mail: <a href="mailto:savoyegregory@yahoo.fr" class="underline">savoyegregory@yahoo.fr</a></p>
                    <p>Pour me contacter par télephone: <a href="tel:+33770507568" class="underline">+33770507568</a></p>
                    <p>Mon adresse: 2b résidence Alfred de Musset, 26100 Romans-sur-Isère</p>
                    <a href="https://goo.gl/maps/uBti6oP8AmMEUG267" class="underline" target="_blank">Je m'y rend</a>
                    <span id="iframeLocation"></span>
                </article>
            </section>
            <hr />
            <section id="admin-space">
                <img src="assets/picture/system/others/administrator.png" alt="Administrateur image" />
                <h1>Espace Administrateur</h1>
                <div>
                    <form action="espace-admin" method="post">
                        <label for="id">Identifiant:</label>
                        <input type="text" placeholder="Votre Identifiant" name="id" id="id" />
                        <br />
                        <label for="pswd">Mot de passe:</label>
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
                        <label for="mail">Votre mail</label>
                        <input type="email" name="mail" id="mail" placeholder="Votre email" />
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
            <span id="enter">Appuyez sur "Entrée" pour fermer</span>
            <span id="cross">X</span>
            </article>
        </section>
    <div style="margin-top: 500px;">end file</div>
</body>

</html>