<?php
use Parse\ParseQuery;
use Parse\ParseObject;
require 'classes/TabProduit.class.php';
require 'classes/Panier.class.php';
require 'classes/Produit.class.php';
$tabBoissons= new TabProduit("boisson");
$tabSnack= new TabProduit("snack");

$etudiant->recuperationPanier();

if(isset($_POST["produit"]))
{
	$choix=new Produit($_POST["produit"]);
	if($choix->existe() && $choix->estDispo())
	{
		$code_erreur=$etudiant->ajouterArticle($choix);
	}else{
		$code_erreur=8;
	}
}

if(isset($_POST["idArticle"]))
{
	$code_erreur=$etudiant->retirerArticle($_POST["idArticle"]);
}

if(isset($_POST["valider"]))
{
	$code_erreur=$etudiant->validerCommande();
}

if(isset($_POST["num_etu"]))
{
	$code_erreur=$etudiant->offrirUnCadeau($_POST["num_etu"]);
}

$etudiant->getPanier()->ajouterNomArticles();
