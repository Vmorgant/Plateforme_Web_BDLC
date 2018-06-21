<?php
	$titre_page='NEWS';

	$page='
	<div class="container-fluid">

    <div class="row">
      <div class="col l6 offset-l3 m12 s12">
        <ul class="tabs">
          <li class="tab col l6 s6 center-align"><a class="active" href="#ajouter">Ajouter</a></li>
          <li class="tab col l6 s6 center-align"><a href="#supprimer">Supprimer</a></li>
        </ul>
      </div>
    </div>

      <div class="container">
        <div class="row">
          <div class="col l6 offset-l3 m8 offset-m2 s12">
            <form method="post" action="index.php?page=gestion_news" enctype="multipart/form-data">
				<div  id="ajouter">
					<div class="row">
						<div class="col l8 m8 s12">	<!-- Input Titre SI AJOUTER -->
							<div class="input-field inline">
								Titre de l\'actualité<input id="titre" type="text" class="validate" name="titre">
							</div>
						</div>

						<div class="col l4 m4 s12">	<!-- Input Nbre jours -->
							<div class="input-field inline">
								Durée en jours<input id="lien" type="text" class="validate" name="date">
								
							</div>
						</div>
					</div>
					<div class="row">         <!-- Input Descriptif -->
						<div class="input-field col s12">
							Texte descriptif<textarea id="descriptif" class="materialize-textarea"  name="details" ></textarea>
						</div>
					</div>
					<div class="row">         <!-- Input Lien -->
						<div class="input-field inline col s12">
							Lien + d\'information<input id="lien" type="url" class="validate"  name="lien">
						</div>
					</div>
					<div class="row">         <!-- Input Image -->
						<div class="col s12">
							<div class="file-field input-field">
								<div class="btn-small bouton">
								<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
								<span>Parcourir</span>
								<input id="affiche" type="file"  name="image">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" >
								<label for="affiche">Illustration / Affiche</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12 right-align">
							<input type="submit" value="Ajouter" class="btn bouton" />
						</div>
					</div>
				</div>

              <div class="row" id="supprimer">         <!-- Input Titre SI MODIFIER -->
                <div class="col s12">
                  <div class="input-field col s12">
                    <select name="news_delect">
						<option value="" disabled selected>Titre (date de fin)</option>';
					foreach($nv->get_news() as $article)
					{
						$page=$page.'
						<option value="'.$article->get("ID_NEWS").'">'.$article->get("TITLE").' (fin le '.$article->get("DATE").')</option>';
					}
					$page=$page.'
                    </select>
                  </div>
                </div>
				<div class="row">
					<div class="col s12 right-align">
						<input type="submit" value="Supprimer" class="btn bouton"  name=/>
					</div>
				</div>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>';
