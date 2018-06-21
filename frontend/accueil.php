<?php
$titre_page="Accueil";

$page='
       <div class="container-fluid">
        <div class="row">
        ';
        $i = 0;

        /* les actualités sont distribués en trois colonnes pour optimiser l'affichage */
        $col1 = '<div class="col l4 m6 s12">
        ';
        $col2 = '<div class="col l4 m6 s12">
        ';
        $col3 = '<div class="col l4 m6 s12">
        '; 
        while(isset($nv->get_news()[$i])) {

            if($nv->comparDate($nv->get_news()[$i]->get("ID_NEWS"))==1 ){
          $element = $nv->get_news()[$i];
          $col1=$col1.'
            <!-- chaque actu est composé d une div de class card (une image + un lien sur modal)-->
                <div class="card">
                    <a href="#'.$element->get("ID_NEWS").'" class="modal-trigger">
                        <div class="card-image">
                            <img src="'.$element->get("PICTURE")->getURL().'">
                        </div>
                    </a>
                </div>
            <!-- et d une div pour le modal (qui ne s affiche) -->

                          <div id="'.$element->get("ID_NEWS").'" class="modal">
                            <div class="modal-content">
                              <h4>Actu</h4>
                              <p>'.$element->get("DETAILS") .' </p>
                            </div>
                            <div class="modal-footer">
                              <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
                              <a href="'.$element->get("LINK").'"class="modal-close waves-effect waves-green btn-flat">+ d\'info</a>
                            </div>
                          </div>'; 
                }           
          $i++;
           
          if(isset($nv->get_news()[$i])&& $nv->comparDate($nv->get_news()[$i]->get("ID_NEWS"))==1){
            
            $element = $nv->get_news()[$i];
              $col2 =$col2.'
                <!-- chaque actu est composé d une div de class card (une image + un lien sur modal)-->
                    <div class="card">
                        <a href="#'.$element->get("ID_NEWS").'" class="modal-trigger">
                            <div class="card-image">
                                <img src="'.$element->get("PICTURE")->getURL().'">
                            </div>
                        </a>
                    </div>
                <!-- et d une div pour le modal (qui ne s affiche) -->

                    <div id="'.$element->get("ID_NEWS").'" class="modal">
                        <div class="modal-content">
                            <h4>'.$element->get("TITLE").'</h4>
                            <p>'.$element->get("DETAILS") .' </p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
                            <a href="'.$element->get("LINK").'"class="modal-close waves-effect waves-green btn-flat">+ d\'info</a>
                        </div>
                    </div>';

            $i++;
          }
          if(isset($nv->get_news()[$i]) && $nv->comparDate($nv->get_news()[$i]->get("ID_NEWS"))==1){
            
            $element = $nv->get_news()[$i];
              $col3 =$col3.'
                <!-- chaque actu est composé d une div de class card (une image + un lien sur modal)-->
                    <div class="card">
                        <a href="#'.$element->get("ID_NEWS").'" class="modal-trigger">
                            <div class="card-image">
                                <img src="'.$element->get("PICTURE")->getURL().'">
                            </div>
                        </a>
                    </div>
                <!-- et d une div pour le modal (qui ne s affiche) -->

                    <div id="'.$element->get("ID_NEWS").'" class="modal">
                        <div class="modal-content">
                            <h4>'.$element->get("TITLE").'</h4>
                            <p>'.$element->get("DETAILS") .' </p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
                            <a href="'.$element->get("LINK").'"class="modal-close waves-effect waves-green btn-flat">+ d\'info</a>
                        </div>
                    </div>';

            $i++;
          }

        }
        $col1 =$col1.'
        </div>';
        $col2 =$col2.'
        </div>';
        $col3 =$col3.'
        </div>';

      /* les trois colonnes sont ensuite concaténées */
        $page=$page.$col1.$col2.$col3.'
          </div>
        </div>

    ';

 ?>
