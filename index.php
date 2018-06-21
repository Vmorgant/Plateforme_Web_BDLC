<?php
/*-----------------------------------------------------------------------------+
|            ENSIM : Projet BDLC - 3A 2017-2018                                |
|  Infos ...                                                                   |
+-----------------------------------------------------------------------------*/
session_start();

include_once('connexionBack4app.php');


/*----------------------------------------------------------------------------*/
/*---------------------routeur------------------------------------------------*/
/*----------------------------------------------------------------------------*/
if(isset($_SESSION["num_etu"]))
{
    //on récupère les infos
    require 'backend/classes/Etudiant.class.php';
    $etudiant=new Etudiant($_SESSION["num_etu"], NULL);
    if(isset($_GET["page"]))
    {
        if($_GET["page"]=="mdp") {              //chgt mdp
            include_once("backend/mdp.php");
            include_once("frontend/mdp.php");

        }elseif($_GET["page"]=="profil") {      //profil
            include_once("backend/profil.php");
            include_once("frontend/profil.php");

        }elseif($_GET["page"]=="commande") {    //commande
            include_once("backend/commande.php");
            include_once("frontend/commande.php");

        }elseif($_GET["page"]=="deconnexion") { //déconnexion
            include_once("backend/deconnexion.php");

        }elseif(($etudiant->getCategorie()=='barista' || $etudiant->getCategorie()=='admin')) {
            if($_GET["page"]=="gestion_news")
            {
                include_once("backend/gnews.php");
                include_once("frontend/gnews.php");

            }elseif($_GET["page"]=="recharger") {
                include_once("backend/recharge.php");
                include_once("frontend/recharge.php");
            }
        }else{
            //par défaut on affiche l'accueil
            include_once("backend/accueil.php");
            include_once("frontend/accueil.php");
        }
    }else{
        //par défaut on affiche l'accueil
        include_once("backend/accueil.php");
        include_once("frontend/accueil.php");
    }
}else{
    if(isset($_GET["page"]) && $_GET["page"]=="connexion") {
        include_once("backend/connexion.php");
        include_once("frontend/connexion.php");
    }else{
        //par défaut on affiche l'accueil
        include_once("backend/accueil.php");
        include_once("frontend/accueil.php");
    }

}
include_once('frontend/page.php');


?>
