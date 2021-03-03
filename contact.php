<?php
	session_start();
	include "connectDB.php";
	if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode']=='contactadmin' && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']))
	{
		$rq="INSERT INTO contact (email,name,subject,message) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['subject']."','".$_POST['message']."')";
		$rs=mysqli_query($con,$rq);
		header("Location: contact.php?mode=thankyou");
	}
	else
	{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>Contacter-nous • LA FEMME</title>
<?php
		include 'inclusion/header';
?>
			<ul class="nav-breadcrumbs linklist navlinks" id="nav-breadcrumbs" role="menubar">
				<li class="breadcrumbs" style="max-width: 5049px;"><span class="crumb"><a accesskey="h" href="index.php" itemprop="url"><i class="icon fa-home fa-fw"></i><span>Accueil</span></a></span><span class="crumb"><span>Contacter-nous</span></span></li>
			</ul><a class="anchor" id="start_here"></a>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<h2 class="titlespace">Contacter l'administrateur</h2>
								<form action="contact.php?mode=contactadmin" method="post">
<?php
		if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode']=='thankyou')
			echo '<div class="panel">Votre message a été envoyé avec succès!</div>';
			else
			{
?>
									<div class="panel">
										<div class="inner">
											<div class="content">
												<fieldset class="fields2">
													<dl>
														<dt><label>Destinataire:</label></dt>
														<dd><strong>Administrateur</strong></dd>
													</dl>
													<dl>
														<dt><label for="email">Votre adresse email:</label></dt>
														<dd><input required="" class="inputbox autowidth" id="email" maxlength="50" name="email" size="50" tabindex="1" type="email" value=""></dd>
													</dl>
													<dl>
														<dt><label for="name">Votre nom:</label></dt>
														<dd><input required="" class="inputbox autowidth" id="name" maxlength="20" name="name" size="50" tabindex="2" type="text" value=""></dd>
													</dl>
													<dl>
														<dt><label for="subject">Sujet:</label></dt>
														<dd><input required="" class="inputbox autowidth" id="subject" maxlength="65" name="subject" size="50" tabindex="3" type="text" value=""></dd>
													</dl>
													<dl>
														<dt><label for="message">Corps du message:</label><br />
														<span>Ce message sera envoyé en texte brut, n'incluez pas de code HTML ou BBCode. L'adresse de retour pour ce message sera définie sur votre adresse e-mail.</span></dt>
														<dd>
														<textarea required="" class="inputbox" cols="76" id="message" maxlength="2000" name="message" rows="15" style="" tabindex="4"></textarea></dd>
													</dl>
												</fieldset>
											</div>
										</div>
									</div>
									<div class="panel">
										<div class="inner">
											<div class="content">
												<fieldset class="submit-buttons">
													<input class="button1" name="submit" tabindex="6" type="submit" value="Envoyer l'email">
												</fieldset>
											</div>
										</div>
									</div>
<?php
			}
?>
								</form>
							</div>
						</div>
					</div>
				</div>
<?php
	include 'inclusion/footer';
	}
?>