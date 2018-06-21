<?php
if(isset($_POST["num_etu"]))
{
    $cible = new Etudiant($_POST["num_etu"], NULL);
    if($cible->verif_existence())
    {
        if($cible->changer_credit($_POST["montant"]))
        {
            $cible->save();
            $code_erreur=2;
        }else{
            $code_erreur=4;
        }
    }else{
        $code_erreur=3;
    }
}
