

    <script src="../java/identification.js"></script>
    
<button id="bclose">X</button>
    <div class=container-general>
        <form method="post" action="PHP/formulaire.php">
        <?php
if(isset($_COOKIE['cookie_ide'])){
       echo '<h2 class="text-danger">erreur dans la saisie</h2>';     }
        ?>
            <div class="formulaire1 contact">
                <label for="Email">Identifiant :</label>
                <input name="Email" type="text" placeholder="Identifiant" required  maxlenght="50">
            </div>
            <div class="formulaire2 contact">
                    <label for="pass">Mot de passe :</label>
                    <input name="Password" type="Password" placeholder="Mot de passe" required  maxlenght="8">
                </div>
            
            <button id='b2' class="boutton-envoyer" value="Submit">
                <span>Envoyer</span>
            </button>
            <a class="lien" href="PHP/inscription.php" >Pas encore inscrit ?</a>
        </form>
        
    </div>  


   