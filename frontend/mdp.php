<?php
$titre_page="Changement mdp";
if(isset($msg_erreur)){echo$msg_erreur;}
$page='
<div class="row">
    <div class="col l4 offset-l4 m4 offset-m4 s12">
        <div class="row valign-wrapper">
            <div class="col l0 m2 s3">
                <a href="index.php?page=profil"><i class="material-icons">arrow_back</i></a>
            </div>
            <div class="col l10 m10 s9">
                <h5>Changement de mot de passe</h5>
            </div>
        </div>
        <form method="post" action="index.php?page=mdp">
            Entrez votre ancien mot de passe<input type="password" name="ancien_mdp" /><br/>
            Entrez votre nouveau mot de passe<input type="password" name="new_mdp"/><br/>
            Entrez à nouveau votre nouveau mot de passe<input type="password" name="confirm_mdp"/><br/>
            <button class="btn waves-effect waves-light bouton" type="submit" name="action">Changer
                 <i class="material-icons left">send</i>
            </button>
        </form>
    </div>
</div>
    ';
