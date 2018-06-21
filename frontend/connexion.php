<?php
$titre_page="Connexion";
$page='';
if(isset($msg_erreur))
{
    $page=$page.$msg_erreur;
}
$page=$page.'
    <div class="row">
        <form method="post" action="index.php?page=connexion" class="col m4 offset-m4 s12">
            Numéro étudiant<input type="text" class="validate" name="login"/><br/>
            Mot de passe<input type="password" class="validate" name="password"/><br/>
            <input type="submit" class="btn bouton" value="Se connecter"/>
        </form>
    </div>
';
