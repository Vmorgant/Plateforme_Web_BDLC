<?php
$titre_page="Panier";
$page='
<div class="row">
    <div class="col l5 offset-l1 m5 offset-m1 s12">
        <div class="row">
            <h5 class="col l6 s12 left-align">Mon panier : '.($etudiant->getPanier()->getPrix()).'€</h5>
            <h5 class="col l6 s12 right-align">Mon solde : '.(floor($etudiant->getCredit()*100)/100).'€</h5>
        </div>
        <table class="row striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>€/unité</th>
                    <th>Qt</th>
                    <th>Supp</th>
                </tr>
            </thead>
            <tbody>';
//affichafe du panier-----------------------------------------------------------
foreach($etudiant->getPanier()->getTabArticle() as $article)
{
    $page=$page.'
                <tr>
                    <td>'.$article->get("NOM_PRODUIT").'</td>
                    <td>'.$article->get("PRIX").'</td>
                    <td>'.$article->get("QUANTITE").'</td>
                    <td>
                        <form action="index.php?page=commande" method="post">
                            <input type="hidden" value="'.$article->getObjectId().'" name="idArticle" />
                            <button class="btn waves-effect waves-light bouton" type="submit" name="action">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
    ';
}
//boutons de validation---------------------------------------------------------
$page=$page.'
            </tbody>
        </table>
        <div class="row">
            <div class="col l8 offset-l2 m10 offset-m1 s10 offset-s1">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">check</i>Commander</div>
                        <div class="collapsible-body">
                            <form action="index.php?page=commande" method="post" class="center-align">
                                <input type="hidden" name="valider"/>
                                <button class="btn waves-effect waves-light bouton" type="submit" name="action">
                                    <i class="material-icons left">check</i>Valider
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">card_giftcard</i>Offrir</div>
                        <div class="collapsible-body">
                            <form action="index.php?page=commande" method="post" class="center-align">
                                <div class="input-field left-align">
                                    Numéro étudiant
                                    <input type="text" name="num_etu"/>
                                </div>
                                <button class="btn waves-effect waves-light bouton" type="submit" name="action">
                                    <i class="material-icons left">card_giftcard</i>Valider
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    ';
//haut du tableau des produits--------------------------------------------------
$page=$page.'
    </div>
    <div class="col l4 offset-l1 m4 offset-m1 s12">
        <div class="row">
            <div class="tabs">
                <li class="tab col s4"><a class="active" href="#boissons">Boissons</a></li>
                <li class="tab col s4"><a href="#snack">Snack</a></li>
                <li class="tab col s4 disabled"><a href="#test3">Formules</a></li>
            </div>
        </div>
        <div class="row" id="boissons">
            <table class="col s12 highlight">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Ajouter</th>
                    </tr>
                </thead>
                <tbody>';
//produits dispos---------------------------------------------------------------
foreach($tabBoissons->getTab() as $boisson)
{
    $page=$page.'
                    <tr>
                        <td class="valign-wrapper">
                            <img src="'.$boisson->get("PICTURE")->getURL().'" class="circle" width="25px"/>
                             '.$boisson->get("NOM").'
                        </td>
                        <td>'.$boisson->get("PRIX_VENTE").'€
                        <td>
                            <form action="index.php?page=commande" method="post">
                                <input type="hidden" value="'.$boisson->get("ID_PRODUIT").'" name="produit"/>
                                <button class="btn waves-effect waves-light bouton" type="submit" name="action">
                                    <i class="material-icons">add</i>
                                </button>
                            </form>
                        </td>
                    </tr>';
}
$page=$page.'
                </tbody>
            </table>
        </div>
        <div class="row" id="snack">
            <table class="col s12 highlight">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Ajouter</th>
                    </tr>
                </thead>
                <tbody>';
foreach($tabSnack->getTab() as $snack)
{
$page=$page.'
                    <tr>
                        <td class="valign-wrapper">
                            <img src="'.$snack->get("PICTURE")->getURL().'" class="circle" width="25px"/>
                             '.$snack->get("NOM").'
                        </td>
                        <td>'.$snack->get("PRIX_VENTE").'€
                        <td>
                            <form action="index.php?page=commande" method="post">
                                <input type="hidden" value="'.$snack->get("ID_PRODUIT").'" name="produit"/>
                                <button class="btn waves-effect waves-light bouton" type="submit" name="action">
                                    <i class="material-icons">add</i>
                                </button>
                            </form>
                        </td>
                    </tr>';
}
$page=$page.'
                </tbody>
                </table>
                </div>
    </div>
</div>
';
