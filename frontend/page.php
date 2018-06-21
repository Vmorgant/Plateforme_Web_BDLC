<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="frontend/css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="frontend/css/style.css"  media="screen,projection"/>
        <?php
            if(isset($etudiant) && $etudiant->getCategorie()!='client')
            {
                echo'
        <link type="text/css" rel="stylesheet" href="frontend/css/style_alternatif.css"  media="screen,projection"/>';
            }
        ?>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>BDLC : <?php echo$titre_page;?></title>
    </head>
<body>
    <div class="container-fluid fond">
        <header class="row valign-wrapper">
            <div class="col l3 offset-l1 m4 offset-m2 s5 offset-s1">
                <a href="#" data-target="slide-out" class="sidenav-trigger btn-floating bouton"><i class="material-icons medium">menu</i></a>
            </div>
            <div class="col l4 m6 s6" style="text-align:center" id="logo">
               <a href="index.php"><img src="frontend/image/logo_BDLC.png" width="100px"/></a>
            </div>
            <div class="col l4 m6 s6 right-align">
                <!--Ici y peu y avoir les liens qui sont dans le footer -->
            </div>
        </header>

                <ul id="slide-out" class="sidenav">
    <?php
    if(isset($etudiant))
    {
        echo'
            <li><a class="subheader"><h5 align="center"> '.$etudiant->getName().'</h5></a></li>
            <li><div class="divider"></div></li>';

        if($etudiant->getCategorie()=='barista' || $etudiant->getCategorie()=='admin')
        {
            echo'
                    <li><a href="index.php"><i class="material-icons">home</i> Accueil</a></li>
                    <li><div class="divider"></div></li>
                    <li><a class="subheader"><i class="material-icons">beach_access</i>Barrista</a></li>
                    <li><a href="index.php?page=recharger"><i class="material-icons">monetization_on</i> Recharger un compte</a></li>
                    <li><a href="#barista" class="disabled"><i class="material-icons">add_shopping_cart</i> Générer commande</a></li>
                    <li><a href="index.php?page=gestion_news"><i class="material-icons">view_agenda</i> Gestion news</a></li>
                    <li><div class="divider"></div></li>';
        }
        echo'
                    <li><a href="index.php?page=commande"><i class="material-icons">shopping_basket</i> Commande</a></li>
                    <li><a href="index.php?page=profil"><i class="material-icons">account_circle</i> Profil</a></li>
                    <li><div class="divider"></div></li>
                    <li><a href="index.php?page=deconnexion"><i class="material-icons">close</i> Déconnexion</a></li>';
    }else{
        echo'
                    <li><a href="index.php"><i class="material-icons">home</i> Accueil</a></li>
                    <li><a href="index.php?page=connexion"><i class="material-icons">account_circle</i> Connexion</a></li>';
    }
    ?>
                </ul>

        <?php if(isset($code_erreur))
        {
            include_once('erreurs.php');
            echo'
            <div class="row center-align">
                <div class="col l6 offset-l3 m12 s12 #ffc107 amber">
                    Info : '.$erreur[$code_erreur].'
                </div>
            </div>';
        } ?>

        <?php echo$page; ?>

        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">À propos</h5>
                        <p class="grey-text text-lighten-4">
                            Plateforme développée dans le cadre du projet BDLC 3A 2018. Pour tout problème, remarque, idée merci de contacter le BDLC.
                        </p>
                    </div>
                    <div class="col l4 offset-l1 s12">

                        <h5 class="white-text">Liens</h5>
                        <div class="row">
                            <div style="margin-bottom: 5px">
                                <a class="waves-effect waves-light btn-small bouton" href="http://ensim-associations.univ-lemans.fr/" style="margin: 5px 5px 5px 0px">Site assos</a>
                                <a class="waves-effect waves-light btn-small bouton" href="https://webensim.univ-lemans.fr/" style="margin: 5px 5px 5px 0px">Webensim</a>
                                <a class="waves-effect waves-light btn-small bouton" href="https://ensim.univ-lemans.fr/" style="margin: 5px 5px 5px 0px">Site ENSIM</a>
                            </div>
                        </div>
                        <div style="margin-bottom: 5px; margin-top: 10px">
                            <a href="https://www.instagram.com/bdlc_ensim/"><img src="frontend/image/instagram.png" alt="Instagram BDLC" style="margin-right: 25px"></a>
                            <a href="https://www.facebook.com/groups/ensim.bdlc/"><img src="frontend/image/facebook.png" alt="Facebook BDLC" style="margin-right: 25px"></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
        <script type="text/javascript" src="frontend/js/materialize.min.js"></script>
        <script>
            M.AutoInit();
        </script>
</body>

</html>
