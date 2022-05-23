<header>
    <div>
    <a href="index.php">
        <h1>Note</h1>
        <h1 class="logo-anim"></h1>
    </a>
        <nav>
            <?php
            if (isset($_SESSION['ID_Utilisateur'])) {
            ?>
                <form action="utilisateur.php">
                    <button id="bouton-back-office" type=submit style="background-image: url(images/icones/clef.svg);"></button>
                </form>
                <form action="PHP/deconnexion.php">
                    <button type=submit style="background-image: url(images/icones/compte-<?= $_SESSION['Sexe'] ?>.svg);"></button>
                </form>
            <?php
            } else {
            ?>
                <button id="b1"></button>
            <?php
            }
            ?>
            <dialog id="dialog" <?php if(isset($_SESSION['error']) && $_SESSION['error']==1){echo'open';$_SESSION['error']=0;setcookie('cookie_ide', 2, time()+10);
            }?>>
                <?php
                include 'PHP/identification.php';
                ?>
            </dialog>
            <input type="checkbox" id="bouton-menu-filtre">
            <div id="menu-filtre">
                <h1>Filtrez votre recherche :</h1>
                <ul>
                    <li>
                        <h2>Famille</h2>
                        <input type="radio" name="famille" onclick="retirer('famille')" checked>
                        <div id="choix-famille">
                            <input type="radio" name="famille" onclick="definir('famille', 'cordes-frottees')" id="famille-cordes-frottees"><label for="famille-cordes-frottees">🎻</label>
                            <input type="radio" name="famille" onclick="definir('famille', 'cordes-pincees')" id="famille-cordes-pincees"><label for="famille-cordes-pincees">🎸</label>
                            <input type="radio" name="famille" onclick="definir('famille','cordes-frappees')" id="famille-cordes-frappees"><label for="famille-cordes-frappees">🎹</label>
                            <input type="radio" name="famille" onclick="definir('famille','vents-bois')" id="famille-vents-bois"><label for="famille-vents-bois">🎷</label>
                            <input type="radio" name="famille" onclick="definir('famille','vents-cuivres')" id="famille-vents-cuivres"><label for="famille-vents-cuivres">🎺</label>
                            <input type="radio" name="famille" onclick="definir('famille','percussions-claviers')" id="famille-percussions-claviers"><label for="famille-percussions-claviers"><img src="images/xylophone.svg"></label>
                            <input type="radio" name="famille" onclick="definir('famille','percussions-peaux')" id="famille-percussions-peaux"><label for="famille-percussions-peaux">🥁</label>
                            <input type="radio" name="famille" onclick="definir('famille','percussions-accessoires')" id="famille-percussions-accessoires"><label for="famille-percussions-accessoires">🔔</label>
                        </div>
                    </li>
                    <li>
                        <h2>Taille</h2>
                        <input type="radio" name="taille" onclick="retirer('taille')" checked>
                        <div id="choix-taille">
                            <input type="radio" name="taille" onclick="definir('taille', 1)" id="taille-1"><label for="taille-1">🐌</label>
                            <input type="radio" name="taille" onclick="definir('taille', 2)" id="taille-2"><label for="taille-2">🐓</label>
                            <input type="radio" name="taille" onclick="definir('taille', 3)" id="taille-3"><label for="taille-3">🐖</label>
                            <input type="radio" name="taille" onclick="definir('taille', 4)" id="taille-4"><label for="taille-4">🐎</label>
                            <input type="radio" name="taille" onclick="definir('taille', 5)" id="taille-5"><label for="taille-5">🐳</label>
                        </div>
                    </li>
                    <li>
                        <h2>Formation</h2>
                        <input type="radio" name="formation" onclick="retirer('formation')" checked>
                        <div id="choix-formation">
                            <input type="radio" name="formation" onclick="definir('formation', 'fanfare')" id="formation-fanfare"><label for="formation-fanfare">Fanfare</label>
                            <input type="radio" name="formation" onclick="definir('formation', 'big-band')" id="formation-big-band"><label for="formation-big-band">Big band</label>
                            <input type="radio" name="formation" onclick="definir('formation', 'harmonie')" id="formation-harmonie"><label for="formation-harmonie">Harmonie</label>
                            <input type="radio" name="formation" onclick="definir('formation', 'groupe-de-rock')" id="formation-groupe-de-rock"><label for="formation-groupe-de-rock">Groupe de rock</label>
                            <input type="radio" name="formation" onclick="definir('formation', 'orchestre-de-chambre')" id="formation-orchestre-de-chambre"><label for="formation-orchestre-de-chambre">Orchestre de chambre</label>
                            <input type="radio" name="formation" onclick="definir('formation', 'orchestre-symphonique')" id="formation-orchestre-symphonique"><label for="formation-orchestre-symphonique">Orchestre symphonique</label>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <form>
        <label for="recherche"><img src="images/icones/loupe.svg" alt=""></label>
        <input type="text" name="recherche" id="recherche" list="liste_filtres">
        <datalist id="liste_filtres">
            <option value="Cordes frottées"></option>
            <option value="Cordes pincées"></option>
            <option value="Cordes frappées"></option>
            <option value="Bois"></option>
            <option value="Cuivres"></option>
            <option value="Percussions à clavier"></option>
            <option value="Percussions à peaux"></option>
            <option value="Accessoires"></option>
            <option value="Fanfare"></option>
            <option value="Big band"></option>
            <option value="Harmonie"></option>
            <option value="Groupe de rock"></option>
            <option value="Orchestre de chambre"></option>
            <option value="Orchestre symphonique"></option>
        </datalist>
        <button type="button" onclick="filtrer_recherche()"><img src="images/icones/suivant.svg" alt=""></button>
    </form>
</header>