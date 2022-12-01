<?php
	session_start();
	if(isset($_SESSION['username'])) header("Location: index.php");
	else
	{
	if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode'] == 'submit')
	{
		include "connectDB.php";
		$rq="SELECT username FROM members WHERE username='".$_POST['username']."'";
		$rs=mysqli_query($con,$rq);
		if (mysqli_num_rows($rs)!=0)
			header('Location: ?mode=register&error=usernameExist');
			else
			{
				$rq="INSERT INTO members (username, email, password, date_j, sex, role) VALUES ('".$_POST['username']."', '".$_POST['email']."', '".$_POST['new_password']."', '".$_POST['date_j']."', '".$_POST['sex']."', '".$_POST['role']."')";
				mysqli_query($con,$rq);
				header('Location: ?mode=success');
			}
	}
	else
	{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>Inscription • PROTECH</title>
<?php
		include 'inclusion/header';
		if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode'] == 'success')
		{
?>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
									<div class="panel">
										<div class="inner">
											<h2>Information</h2>
											<p>Merci de votre inscription, votre compte a été créé! Vous pouvez maintenant vous connecter avec votre nom d'utilisateur et votre mot de passe.<br /><br /><a href="login.php">Se connecter maintenant</a></p>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>

<?php
		}
		else
		if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode'] == 'register')
		{
?>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<form action="register.php?mode=submit" id="register" method="post" name="register">
									<div class="panel">
										<div class="inner">
											<h2>PROTECH - Inscription</h2>
											<fieldset class="fields2">
<?php
			if (isset($_REQUEST['error']) && !empty($_REQUEST['error']) && $_REQUEST['error'] == 'usernameExist')
				echo "<dl><dd class='error'>Nom d'utilisateur existe déjà.</dd></dl>";
?>
                                                <dl>
                                                    <dt><label for="username">Nom d'utilisateur:</label></dt>
                                                    <dd><input pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" autofocus required class="inputbox autowidth" id="username" name="username" size="25" tabindex="1" title="Username" type="text" value="">
                                                        <br /><span>(La longueur doit être comprise entre 3 et 20 caractères.)</span></dd>
                                                </dl>
                                                <dl>
                                                    <dt><label for="sex">Sexe:</label></dt>
                                                    <dd>
                                                        <select id="sex" name="sex" required>
                                                            <option value="m">Male</option>
                                                            <option value="f">Female</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt><label for="role">Role:</label></dt>
                                                    <dd>
                                                        <select id="role" name="role" required>
                                                            <option value="user">Utilisateur</option>
                                                            <option value="doctor">Medecin</option>
                                                        </select>
                                                    </dd>
                                                </dl>
												<dl>
													<dt><label for="email">Adresse e-mail:</label></dt>
													<dd><input required class="inputbox autowidth" id="email" maxlength="100" name="email" size="25" tabindex="2" title="Email address" type="email" value=""></dd>
												</dl>
												<dl>
													<dt><label for="new_password">Mot de passe:</label></dt>
													<dd><input required autocomplete="off" pattern=".{6,100}" class="inputbox autowidth" id="new_password" name="new_password" size="25" tabindex="4" title="New password" type="password" value="">
													<br /><span>(Doit être compris entre 6 et 100 caractères.)</span></dd>
												</dl>
												<dl>
													<dt><label for="password_confirm">Confirmez le mot de passe:</label></dt>
													<dd><input required autocomplete="off" class="inputbox autowidth" id="password_confirm" name="password_confirm" size="25" tabindex="5" title="Confirm password" type="password" value=""></dd>
												</dl>
												<script language="javascript">
													var password = document.getElementById("new_password"), confirm_password = document.getElementById("password_confirm");
													function validatePassword()
													{
														if(password.value != confirm_password.value)
															confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
														else
															confirm_password.setCustomValidity('');
													}
													password.onchange = validatePassword;
													confirm_password.onkeyup = validatePassword;
												</script>
												<input type="hidden" name="date_j" id="date_j" />
												<script>
													var d=new Date;
													document.getElementById('date_j').value=d.getDate()+"-"+(d.getMonth()+1)+"-"+d.getFullYear();
												</script>
											</fieldset>
										</div>
									</div>
									<div class="panel">
										<div class="inner">
											<fieldset class="submit-buttons">
												<input class="button2" name="reset" type="reset" value="Réinitialiser" />&nbsp; <input class="button1 default-submit-action" id="submit" name="submit" tabindex="9" type="submit" value="Valider" />
											</fieldset>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
<?php
		}
		else
		{
?>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<form action="register.php?mode=register" id="agreement" method="post" name="agreement">
									<div class="panel">
										<div class="inner">
											<div class="content">
												<h2 class="sitename-title">PROTECH - Inscription</h2>
												<p>En accédant à la forum de "PROTECH", vous acceptez d'être légalement lié par les termes suivants. Si vous n'acceptez pas d'être légalement responsable de toutes les conditions suivantes, veuillez ne pas utiliser et / ou accéder à "PROTECH". Nous pouvons les modifier à tout moment et nous ferons de notre mieux pour vous informer, bien qu'il soit prudent de les consulter régulièrement car votre utilisation continue de "PROTECH" après les changements signifie que vous acceptez d'être légalement lié par ces termes. comme ils sont mis à jour et / ou modifiés.<br />
												<br />
												Vous acceptez de ne pas publier de contenu abusif, obscène, vulgaire, diffamatoire, choquant, menaçant, à caractère sexuel ou autre qui peut transgresser les lois de votre pays, du pays où "PROTECH" est hébergé ou les lois internationales. Cela pourrait entraîner votre bannissement immédiat et permanent, avec notification de votre fournisseur d'accès Internet si nous le jugeons nécessaire. L'adresse IP de tous les messages est enregistrée pour faciliter l'application de ces conditions. Vous acceptez que "PROTECH" supprime, édite, déplace ou verrouille n'importe quel sujet lorsque nous estimons que cela est nécessaire. En tant qu'utilisateur, vous acceptez que toutes les informations que vous avez saisies soient stockées dans une base de données.</p>
											</div>
										</div>
									</div>
									<div class="panel">
										<div class="inner">
											<fieldset class="submit-buttons">
												<input class="button1" id="agreed" name="agreed" type="submit" value="Je suis d'accord avec ces termes">&nbsp; <a href="javascript: window.history.back();"><input class="button2" name="not_agreed" type="button" value="Je ne suis pas d'accord avec ces termes"></a>
											</fieldset>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
<?php
		}
?>
<?php
		include 'inclusion/footer';
?>
<?php
	}
	}
?>
