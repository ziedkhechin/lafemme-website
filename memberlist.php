<?php
	session_start();
	include "connectDB.php";
	if(!isset($_SESSION['username']))
		header("Location: login.php");
		else
		{
			if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode'] == 'viewprofile' && isset($_REQUEST['username']) && !empty($_REQUEST['username']))
			{
				$rq1="SELECT * FROM members WHERE username='".$_REQUEST['username']."'";
				$rs1=mysqli_query($con,$rq1);
				if(mysqli_num_rows($rs1)==0)
				{
					header("Location: index.php");
				}
				else
				{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
<?php
					echo '	<title>'.strtoupper($_REQUEST['username']).' • PROTECH</title>
';
					include 'inclusion/header';
					$rq2="SELECT * FROM members WHERE username='".$_REQUEST['username']."'";
					$rq3="SELECT id_p FROM posts WHERE author='".$_REQUEST['username']."'";
					$rq4="SELECT id_p FROM posts";
					$rq2=mysqli_query($con,$rq2);
					$rq3=mysqli_query($con,$rq3);
					$rq4=mysqli_query($con,$rq4);
					$rows=mysqli_fetch_assoc($rq2);
                    $avatar=getAvatar($con, $_REQUEST['username']);
?>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<h2 class="memberlist-title">Voir le profile - <?php echo $_REQUEST['username']; ?></h2>
								<div class="panel bg1">
									<div class="inner">
										<dl class="left-box">
											<dt class="profile-avatar"><img class="avatar" src="<?php echo $avatar; ?>" width="150" height="150" alt="Photo de Profile"></dt>
										</dl>
										<dl class="left-box details profile-details">
											<dt>Nom d'utilisateur:</dt>
											<dd><span><?php echo $rows['username']; ?></span></dd>
											<dt>Email:</dt>
											<dd><span><?php echo "<a href=\"mailto:{$rows['email']}\">{$rows['email']}</a>"; ?></span></dd>
											<dt>Rang:</dt>
											<dd><span><?php if($rows['role']==='admin') echo 'Admin de Site'; elseif($rows['role']==='user') echo 'Utilisateur'; else echo 'Medecin'; ?></span></dd>
										</dl>
									</div>
								</div>
								<div class="panel bg2">
									<div class="inner">
										<div class="column2">
											<h3 style="font-weight: bold;">Statistiques de l'utilisateur</h3>
											<dl class="details">
												<dt>Joindre:</dt>
												<dd><?php echo $rows['date_j']; ?></dd>
												<dt>Total des publications:</dt>
												<dd><?php echo mysqli_num_rows($rq3); ?><br>(<?php if (mysqli_num_rows($rq3)!=0) echo number_format(mysqli_num_rows($rq3)*100/mysqli_num_rows($rq4) ,2); else echo '0'; ?>% de tous les publications.)</dd>
												<dt>Forum le plus actif:</dt>
												<dd> - </dd>
												<dt>Sujet le plus actif:</dt>
												<dd> - </dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php
				}
			}
			else
			{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>Membres • PROTECH</title>
<?php
				include 'inclusion/header';
?>
			<ul class="nav-breadcrumbs linklist navlinks" id="nav-breadcrumbs" role="menubar">
				<li class="breadcrumbs" style="max-width: 5049px;"><span class="crumb"><a accesskey="h" href="index.php"><i class="icon fa-home fa-fw"></i><span>Accueil</span></a></span><span class="crumb"><span>Membres</span></span></li>
			</ul>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<form method="post" action="./memberlist.php">
									<h2 class="solo">Membres</h2>
									<div class="forumbg forumbg-table">
										<div class="inner">
											<table class="table1 memberlist show-header responsive" id="memberlist">
												<thead>
													<tr>
														<th class="name">
															<span class="rank-img">Rang</span>
															Nom d'utilisateur
														</th>
														<th class="posts">Postes</th>
														<th class="joined">Joindre	</th>
													</tr>
												</thead>
												<tbody>
<?php
				$rq1="SELECT * FROM members ORDER BY username";
				$rs1=mysqli_query($con,$rq1);
				while($rows1=mysqli_fetch_assoc($rs1))
				{
					$rq2="SELECT id_p FROM posts WHERE author='".$rows1['username']."'";
					$rs2=mysqli_query($con,$rq2);
?>
													<tr class="bg1">
														<td><?php
																echo '<span class="rank-img">';
                                                                if($rows1['role']==='admin')
                                                                    echo 'Admin de Site';
                                                                elseif($rows1['role']==='user')
                                                                    echo 'Utilisateur';
                                                                else echo 'Medecin';
																echo '</span><span class="username-coloured">';
																if($rows1['role']!='admin'||$rows1['role']=='admin'&&isset($_SESSION['role'])&&$_SESSION['role']=='admin')
																	echo '<a href="memberlist.php?mode=viewprofile&username='.$rows1["username"].'">';
																echo $rows1['username'];
																if($rows1['role']!='admin'||$rows1['role']=='admin'&&isset($_SESSION['role'])&&$_SESSION['role']=='admin')
																	echo '</a>';
																echo '</span>';
															?>
														</td>
														<td class="posts"><?php echo mysqli_num_rows($rs2); ?></td>
														<td><?php echo $rows1['date_j']; ?></td>
													</tr>
<?php
				}
?>
												</tbody>
											</table>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
<?php
			}
			include 'inclusion/footer';
		}
	exit;
?>
