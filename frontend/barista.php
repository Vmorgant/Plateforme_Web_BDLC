<?php
	$titre_page='barista';
	$page='
	<!--Test lecture QRCODE-->
	<script type="text/javascript" src="instascan.min.js"></script>
		<div class="row">
			<div class="col l6 offset-l3 m12 s12">
				<div class="preview-container">
					<video id="preview"></video>
				</div>
				<script type="text/javascript">
				  let scanner = new Instascan.Scanner({ video: document.getElementById("preview") });
				  scanner.addListener("scan", function (content) {
					console.log(content);
				  });
				  Instascan.Camera.getCameras().then(function (cameras) {
					if (cameras.length > 0) {
					  scanner.start(cameras[0]);
					} else {
					  console.error("No cameras found.");
					}
				  }).catch(function (e) {
					console.error(e);
					});
				</script>
			</div>
		</div>
	';
