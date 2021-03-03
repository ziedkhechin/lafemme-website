<?php
	session_start();
	if(isset($_SESSION['username'])) header("Location: index.php");
	else
	{
	session_destroy();
	if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode'] == 'login')
	{
		include "connectDB.php";
		if($_POST['username']=="") header('Location: ?error=wrongusername');
		else
		if($_POST['password']=="") header('Location: ?error=nopassword');
		else
		{
			$rq="SELECT username FROM members WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";
			$res=mysqli_query($con,$rq);
			if (mysqli_num_rows($res)==0)
				header('Location: ?error=wrongusername');
				else
				{
					session_start();
					$_SESSION["username"]=$_POST['username'];
					header("Location: index.php");
					exit;
				}
		}
	}
	else
	{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>Se connecter • LA FEMME</title>
<?php
		include "inclusion/head_elements";
?>
</head>
<body class="notouch section-ucp ltr sidebar-right-only body-layout-Fluid auth-page hasjs" id="phpbb">
	<div class="login_container">
		<div class="login_container_left">
			<div style="min-height: unset;" class="login_container_left_section_content fancy_panel animated fadeIn">
				<div class="login_container_padding login_form">
					<h2 class="login-title">Se connecter</h2>
					<form action="login.php?mode=login" data-focus="username" id="login" method="post" name="login">
						<fieldset class="fields1">
<?php
		if (isset($_REQUEST['error']) && !empty($_REQUEST['error']) && $_REQUEST['error'] == 'nopassword')
		{
			echo '<div class="error">Vous ne pouvez pas vous connecter sans mot de passe.</div>';
		}
		else
		if (isset($_REQUEST['error']) && !empty($_REQUEST['error']) && $_REQUEST['error'] == 'wrongusername')
		{
			echo "<div class='error'>Vous avez spécifié un nom d'utilisateur ou un mot de passe incorrect. Veuillez vérifier votre login et réessayer. Si vous continuez à avoir des problèmes, veuillez contacter <a class='error' href='contact.php'>l'administrateur du Conseil</a>.</div>";
		}
?>
							<div>
								<label for="username">Nom d'utilisateur</label> <input class="inputbox" id="username" name="username" size="25" tabindex="1" type="text" value="">
							</div>
							<div>
								<label for="password">Mot de passe</label> <input autocomplete="off" class="inputbox" id="password" name="password" size="25" tabindex="2" type="password">
							</div>
							<input class="button2 specialbutton" name="login" tabindex="6" type="submit" value="Connecter">
						</fieldset>
					</form>
					<div class="action-bar" style="margin: 0;">
						<p><a accesskey="r" class="left-box arrow-left" href="javascript: window.history.back();"><i class="icon fa-angle-left fa-fw icon-black"></i><span>Retourner</span></a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="login_container_right">
			<div class="login_container_right_section_content fancy_panel animated fadeIn">
				<div class="login_container_padding">
					<h3>Inscription</h3>
					<p class="login_container_info">pour vous connecter, vous devez être inscrit. L'inscription ne prend que quelques instants, mais vous offre des capacités accrues. L'administrateur du forum peut également accorder des autorisations supplémentaires aux utilisateurs enregistrés. Avant de vous inscrire, veuillez vous assurer de connaître nos conditions d'utilisation et les politiques connexes. Veuillez vous assurer de lire les règles lorsque vous naviguez sur le forum.</p>
					<p><a class="button2 specialbutton" href="register.php">Register</a></p>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js?assets_version=21"  type="text/javascript"></script>
	<script src="js/core.js?assets_version=21" type="text/javascript"></script>
	<script src="js/forum_fn.js?assets_version=21" type="text/javascript"></script>
	<script src="js/ajax.js?assets_version=21" type="text/javascript"></script>
</body>
</html>
<?php
	}
	}
?>