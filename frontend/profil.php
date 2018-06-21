
<?php
	$titre_page='Profil';
	$num=$etudiant->getNum();
	$i=0;
	$page='
		<div class="row">
			<div class="col l6 offset-l3 m12 s12">
				<ul class="tabs">
					<li class="tab col l6 s6 center-align"><a class="active" href="#profil">Mon Profil</a></li>
					<li class="tab col l6 s6 center-align"><a href="#commandes">Mes commandes</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col l6 offset-l3 m12 s12">
				<h5 class="row center-align">Bonjour '.($etudiant->getName()).'</h5>
				<div class="row center-align">
					<h6>Solde : '.($etudiant->getCredit()).'€</h6>
				</div>

				<div class="row center-align" id="profil">
					<div class="col s12">
						<div class="row center-align">
							<script type="text/javascript" src="jquery.min.js"></script>
							<script type="text/javascript" src="frontend/js/qrcode.js"></script>
							<div class="col l4 offset-l4 m6 offset-m3 s8 offset-s2" align="center">
								<div id="qrcode"></div>
							</div>
							<script type="text/javascript">
								var qrcode = new QRCode(document.getElementById("qrcode"), {
									width : 100,
									height : 100
								});
								qrcode.makeCode("'.$num.'");
							 </script>
						</div>
						<h6 class="row center-align">'.$num.'</h6>
						<a class="waves-effect waves-light btn bouton" href="index.php?page=mdp">
							<i class="material-icons right">
								border_color
							</i>
							Changer mon mot de passe
						</a>
					</div>
				</div>
				<div class="row" id="commandes">
					 <table class="col s12 highlight">
							<thead>
								<tr>
									<th>ID</th>
									<th>Prix</th>
									<th>Etat</th>
								</tr>
							</thead>
							<tbody>';
									while($panier=$tabPanier->getPanier())
									{
										$page=$page.'
											<tr>
												<td>'.$panier->get("ID_PANIER").'</td>
												<td>'.$panier->get("PRIX_TOTAL").'€</td>
												<td>';
												if($panier->get("STATE") == "commande")
												  {
												  $page=$page.'
													<div id="qrcodecmd'.$panier->get("ID_PANIER").'"></div>
													<script type="text/javascript">
														var qrcodecmd$i = new QRCode(document.getElementById("qrcodecmd'.$panier->get("ID_PANIER").'"), {
															width : 100,
															height : 100
														});
														qrcodecmd$i.makeCode("'.$panier->get("ID_PANIER").'");
													 </script>';


												 }else{
													 $page=$page.$panier->get("STATE");
												 }
												  $page=$page.'</td>';
										 $page=$page.'
											</tr>';
									 $i++;
									}
									$page=$page.'
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	';
?>
