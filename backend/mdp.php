<?php

    use Parse\ParseQuery;
    use Parse\ParseObject;
if(isset($_POST["ancien_mdp"]) && isset($_POST["new_mdp"]) && isset($_POST["confirm_mdp"]))
{
    $code_erreur=$etudiant->changer_mdp($_POST["ancien_mdp"],$_POST["new_mdp"],$_POST["confirm_mdp"]);
}
