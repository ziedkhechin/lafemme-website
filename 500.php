<?php
	session_start();
	include "connectDB.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>500 • PROTECH</title>
<?php
		include 'inclusion/header';
?>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<div class="panel" id="message">
									<div class="inner"><h2 class="message-title">Information</h2><p>Une erreur inattendue s'est produite, empêchant la chargement de la page.</p><a href="index.php">Retour à la page d'accueil</p></div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php
	include 'inclusion/footer';
?>
