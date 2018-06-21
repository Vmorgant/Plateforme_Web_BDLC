<?php

    use Parse\ParseQuery;
    use Parse\ParseObject;
if(isset($_POST["login"]) && isset($_POST["password"]))
{
    $query = new ParseQuery("TABLE_USER");
    $query->equalTo("NUM_ETU", $_POST["login"]);
    $result = $query->find();
    if($result!=NULL)
    {
        $etudiant=$result["0"];

        //cryptage à ajouter ici
        //pb de sécurité ?
        if($etudiant->get('MDP')==$_POST["password"])
        {
            $_SESSION["num_etu"]=$etudiant->get("NUM_ETU");
            header('Location: index.php');
            echo'Vous êtes désormais connectés. <a href="index.php">Continuer</a>';
        }else{
            $code_erreur=10;
            unset($etudiant);
        }
    }else{
        $code_erreur=11;
    }
}
else {
	$code_erreur=12;
}
