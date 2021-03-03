<?php
	session_start();
	include "connectDB.php";
	if (isset($_REQUEST['id']) && !empty($_REQUEST['id']) && !isset($_REQUEST['category']))
	{
		$rq1="SELECT * FROM posts WHERE id_p='".$_REQUEST['id']."'";
		$rs1=mysqli_query($con,$rq1);
		if(mysqli_num_rows($rs1)==0)
		{
			header("Location: viewforum.php");
		}
		else
		{
			$rows1=mysqli_fetch_assoc($rs1);
			$rq2="SELECT * FROM members WHERE username='".$rows1['author']."'";
			$rows2=mysqli_fetch_assoc(mysqli_query($con,$rq2));
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title><?php echo $rows1['title']; ?> • LA FEMME</title>
<?php
			include 'inclusion/header';
			$rq3="SELECT id_c FROM comments c, posts p WHERE c.id_p=p.id_p AND p.id_p=".$_REQUEST['id'];
			$rq4="SELECT c.date, c.author, c.text FROM comments c, posts p WHERE c.id_p=p.id_p AND c.id_p='".$rows1['id_p']."' ORDER BY c.date_ls";
			$rs2=mysqli_query($con,$rq3);
			$rs3=mysqli_query($con,$rq4);
?>
			<ul class="nav-breadcrumbs linklist navlinks" id="nav-breadcrumbs" role="menubar">
				<li class="breadcrumbs" style="max-width: 5049px;"><span class="crumb"><a accesskey="h" href="index.php"><i class="icon fa-home fa-fw"></i><span>Accueil</span></a></span><span class="crumb"><a accesskey="h" href="viewforum.php"><span>Publications</span></a></span><span class="crumb"><span><?php echo $rows1['title']; ?></span></span></</li>
			</ul>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<div class="postprofile_container postprofile_Right postprofile_Vertical">
									<div class="rules">
										<div class="inner">
											<strong>Règles du forum:</strong><br />
											Sur le forum, une écriture correcte et lisible est de mise ! Le langage abrégé type « SMS » conviendra parfaitement à votre téléphone portable, mais pas aux discussions sur les forums.
											Ecrire correctement, faire un minimum attention à son orthographe, à la ponctuation, et aux fautes de frappe, constituent les règles basiques du respect d’autrui. Si vous ne faites pas l’effort de bien écrire, les membres ne feront pas l’effort de vous lire ou de vous répondre.<br /><br />
											Les propos à caractère politique, religieux, diffamatoire, menaçant, raciste, xénophobe, pédophile, obscène, pornographique sont formellement proscrits. Dans ce contexte, Il est également interdit de publier des liens vers des sites ayant un tel contenu.
										</div>
									</div>
									<div class="action-bar bar-top">
<?php
			if(isset($_SESSION['username']))
			{
?>
										<form method="post" action="posting.php?mode=reply">
											<input required="" placeholder="Votre commentaire..." type="text" name="comment" class="inputbox" maxlength="2000" style="height: 36px; width: 88.5886%; margin: 0 0 4px 0; border-color: #edecec; background-color: #FFFFFF;" />
											<input name="forum_id" value="<?php echo $_REQUEST['id']; ?>" type="hidden" />
											<input type="hidden" name="date_cur" id="date_cur" />
											<script>
												var d=new Date;
												document.getElementById('date_cur').value=d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+" "+d.getDate()+"-"+(d.getMonth()+1)+"-"+d.getFullYear();
											</script>
											<button type="submit" class="button specialbutton" style="margin: 0 0 4px 0; float: unset;" title="Poster une commentaire"><span>Répondre</span> <i class="icon fa-reply fa-fw"></i></button>
										</form>
<?php
			}
?>
										<div class="pagination"><?php echo mysqli_num_rows($rs2); ?> commentaires</div>
									</div>
									<style>
										@media (max-width: 700px)
										{
											hidn{    display: block;}
										}
									</style>
									<div class="viewtopic_wrapper">
										<div class="post has-profile bg1">
											<div class="inner">
												<dl class="postprofile">
													<dd>
														<div class="avatar-container">
															<?php if($rows1['author']!='admin'||$rows1['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a class="avatar" href="memberlist.php?mode=viewprofile&username='.$rows2['username'].'">'; ?><img alt="Photo Profile" class="avatar" src="<?php echo $rows2['avatar']; ?>" width="100"><?php if($rows1['author']!='admin'||$rows1['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?>
														</div>
													</dd>
													<?php if($rows1['author']!='admin'||$rows1['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a class="username-coloured" style="color: #AA0000;" href="memberlist.php?mode=viewprofile&username='.$rows2['username'].'">'; echo $rows2['username']; ?><?php if($rows1['author']!='admin'||$rows1['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?>
												</dl>
												<div class="postbody">
													<div id="post_content38">
														<h3><?php echo $rows1['title']; ?></h3>
														<ul class="post-buttons">
															<li>
																<a class="button button-icon-only"><i class="icon fa-quote-left fa-fw"></i><span class="sr-only"></span></a>
															</li>
														</ul>
														<p class="author"><i class="icon fa-clock-o"></i> <?php echo $rows1['date']; ?></p>
														<div class="content"><?php echo $rows1['text']; ?></div>
													</div>
												</div>
											</div>
										</div>
<?php
			while($rows00=mysqli_fetch_assoc($rs3))
			{
				$rq01="SELECT avatar FROM members WHERE username='".$rows00['author']."'";
				$rows01=(mysqli_fetch_assoc(mysqli_query($con,$rq01)));
?>
										<div class="post has-profile">
											<div class="inner">
												<dl class="postprofile">
													<dd>
														<div class="avatar-container">
															<?php if($rows00['author']!='admin'||$rows00['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a class="avatar" href="memberlist.php?mode=viewprofile&username='.$rows00['author'].'">'; ?><img alt="Photo Profile" class="avatar" src="<?php echo $rows01['avatar']; ?>" width="50"><?php if($rows00['author']!='admin'||$rows00['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?>
														</div>
													</dd>
													<?php if($rows00['author']!='admin'||$rows00['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a class="username-coloured" style="color: #AA0000;" href="memberlist.php?mode=viewprofile&username='.$rows00['author'].'">'; echo $rows00['author']; ?><?php if($rows00['author']!='admin'||$rows00['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?>
												</dl>
												<div class="postbody">
													<div id="post_content38">
														<p class="author"><i class="icon fa-clock-o"></i> <?php echo $rows00['date']; ?></p>
														<div class="content"><?php echo $rows00['text']; ?></div>
													</div>
												</div>
											</div>
										</div>
<?php
			}
?>
									</div>
									<div class="action-bar bar-bottom">
<?php
			if(isset($_SESSION['username']))
			{
?>
										<form method="post" action="posting.php?mode=reply">
											<input required="" placeholder="Votre commentaire..." type="text" name="comment" class="inputbox" maxlength="2000" style="height: 36px; width: 88.5886%; margin: 0 0 4px 0; border-color: #edecec; background-color: #FFFFFF;" />
											<input name="forum_id" value="<?php echo $_REQUEST['id']; ?>" type="hidden" />
											<input type="hidden" name="date_cur" id="date_cur_c2" />
											<script>
												var d=new Date;
												document.getElementById('date_cur_c2').value=d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+" "+d.getDate()+"-"+(d.getMonth()+1)+"-"+d.getFullYear();
											</script>
											<button type="submit" class="button specialbutton" style="margin: 0 0 4px 0; float: unset;" title="Poster une commentaire"><span>Répondre</span> <i class="icon fa-reply fa-fw"></i></button>
										</form>
<?php
			}
?>
										<div class="pagination"><?php echo mysqli_num_rows($rs2); ?> commentaires</div>
										<div class="back2top">
											<a class="top" href="#top" title="Haut"><i class="icon fa-chevron-circle-up fa-fw icon-gray"></i> <span class="sr-only">Haut</span></a>
										</div>
									</div>
									<div class="action-bar actions-jump">
										<p class="jumpbox-return"><a accesskey="r" class="left-box arrow-left" href="javascript: window.history.back();"><i class="icon fa-angle-left fa-fw icon-black"></i><span>Retourner</span></a></p>
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
	if (isset($_REQUEST['category']) && !empty($_REQUEST['category']) && !isset($_REQUEST['id']))
	{
		$rq1="SELECT * FROM category WHERE id_cat='".$_REQUEST['category']."'";
		$rs1=mysqli_query($con,$rq1);
		if(mysqli_num_rows($rs1)==0)
		{
			header("Location: viewforum.php");
		}
		else
		{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title><?php $rows1=mysqli_fetch_assoc($rs1); echo $rows1['name']; ?> • LA FEMME</title>
<?php
			include 'inclusion/header';
?>
			<ul class="nav-breadcrumbs linklist navlinks" id="nav-breadcrumbs" role="menubar">
				<li class="breadcrumbs" style="max-width: 5049px;"><span class="crumb"><a accesskey="h" href="index.php"><i class="icon fa-home fa-fw"></i><span>Accueil</span></a></span><span class="crumb"><a accesskey="h" href="viewforum.php"><span>Publications</span></a></span><span class="crumb"><span>Catégories</span></span><span class="crumb"><span><?php echo $rows1['name']; ?></span></span></</li>
			</ul>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<div id="forumlist_collapse">
										<div class="forabg">
											<div class="inner">
												<ul class="topiclist">
													<li class="header">
														<dl class="row-item">
															<dt><div class="list-inner"><?php echo $rows1['name']; ?></div></dt>
															<dd style="margin-left: 95px;" class="posts"><span class="icon fa-comments" title="Commentaires"></span></dd>
															<dd class="lastpost"><span><span class="icon fa-clock-o"></span></span></dd>
														</dl>
													</li>
												</ul>
												<ul class="topiclist forums">
<?php
		$rq1="SELECT * FROM posts WHERE category='".$_REQUEST['category']."' ORDER BY date_ls DESC";
		$rs1=mysqli_query($con,$rq1);
		if(mysqli_num_rows($rs1)==0)
		{
			echo "Ce bord n'a pas de forums!";
		}
		else
		{
			while($rows2=mysqli_fetch_assoc($rs1))
			{
				$rq2="SELECT avatar FROM members WHERE username='".$rows2['author']."'";
				$rq3="SELECT id_c FROM comments c, posts p WHERE c.id_p=p.id_p AND p.id_p=".$rows2['id_p'];
				$rq4="SELECT name FROM category cat, posts p WHERE cat.id_cat=p.category AND p.id_p=".$rows2['id_p'];
				$rs2=mysqli_query($con,$rq2);
				$rs3=mysqli_query($con,$rq3);
				$rs4=mysqli_query($con,$rq4);
			
?>
													<li class="row has_last_post_avatar">
														<dl class="row-item forum_read">           
															<dt>
																<div style="width: 510px" class="list-inner">
																	<a href="viewforum.php?id=<?php echo $rows2['id_p']; ?>" class="forumtitle"><?php echo $rows2['title']; ?></a>
																	<br /><span class="forum_description"><?php $a=mysqli_fetch_assoc($rs4); echo $a['name']; ?></span>
																	<div class="responsive-show responsive_forumlist_row_stats" style="display: none;">
																		Par: <strong><?php if($rows2['author']!='admin'||$rows2['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a href="memberlist.php?mode=viewprofile&username='.$rows2['author'].'" style="color: #AA0000;" class="username-coloured">'; echo $rows2['author']; if($rows2['author']!='admin'||$rows2['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?></strong>
																		&nbsp;| Commentaires: <strong><?php echo mysqli_num_rows($rs3); ?></strong>
																	</div>
																</div>
															</dt>
															<dd style="margin-left: 95px;" class="posts"><?php echo mysqli_num_rows($rs3); ?></dd>
															<dd class="lastpost">
																<span>
																	<dfn>Last post</dfn>
																	
																	<span class="lastpostavatar"><img class="avatar" src="<?php $a=mysqli_fetch_assoc($rs2); echo $a['avatar']; ?>" width="30" height="30" title="Photo de Profile" alt="Photo de Profile"></span>
																	par <?php if($rows2['author']!='admin'||$rows2['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a href="memberlist.php?mode=viewprofile&username='.$rows2['author'].'" style="color: #AA0000;" class="username-coloured">'; echo $rows2['author']; if($rows2['author']!='admin'||$rows2['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?>
                                                                    <br /><br /><?php echo $rows2['date']; ?>
																</span>
															</dd>
														</dl>
													</li>
<?php
			}
		}
?>
												</ul>
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
	<title>Dernière Activités • LA FEMME</title>
<?php
		include 'inclusion/header';
?>
			<ul class="nav-breadcrumbs linklist navlinks" id="nav-breadcrumbs" role="menubar">
				<li class="breadcrumbs" style="max-width: 5049px;"><span class="crumb"><a accesskey="h" href="index.php"><i class="icon fa-home fa-fw"></i><span>Accueil</span></a></span><span class="crumb"><a accesskey="h" href="viewforum.php"><span>Publications</span></a></span><span class="crumb"><span>Dernière Activités</span></span></li>
			</ul>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<div id="forumlist_collapse">
										<div class="forabg">
											<div class="inner">
												<ul class="topiclist">
													<li class="header">
														<dl class="row-item">
															<dt><div class="list-inner">Dernière Activités</div></dt>
															<dd style="margin-left: 95px;" class="posts"><span class="icon fa-comments" title="Commentaires"></span></dd>
															<dd class="lastpost"><span><span class="icon fa-clock-o"></span></span></dd>
														</dl>
													</li>
												</ul>
												<ul class="topiclist forums">
<?php
		$rq1="SELECT * FROM posts ORDER BY date_ls DESC";
		$rs1=mysqli_query($con,$rq1);
		if(mysqli_num_rows($rs1)==0)
		{
			echo "Ce bord n'a pas de forums!";
		}
		else
		{
			while($rows=mysqli_fetch_assoc($rs1))
			{
				$rq2="SELECT avatar FROM members WHERE username='".$rows['author']."'";
				$rq3="SELECT id_c FROM comments c, posts p WHERE c.id_p=p.id_p AND p.id_p=".$rows['id_p'];
				$rq4="SELECT name FROM category cat, posts p WHERE cat.id_cat=p.category AND p.id_p=".$rows['id_p'];
				$rs2=mysqli_query($con,$rq2);
				$rs3=mysqli_query($con,$rq3);
				$rs4=mysqli_query($con,$rq4);
			
?>
													<li class="row has_last_post_avatar">
														<dl class="row-item forum_read">           
															<dt>
																<div style="width: 510px" class="list-inner">
																	<a href="viewforum.php?id=<?php echo $rows['id_p']; ?>" class="forumtitle"><?php echo $rows['title']; ?></a>
																	<br /><span class="forum_description"><a href="viewforum.php?category=<?php echo $rows['category']; ?>"><?php $a=mysqli_fetch_assoc($rs4); echo $a['name']; ?></a></span>						                                                            
																	<div class="responsive-show responsive_forumlist_row_stats" style="display: none;">
																		Par: <strong><?php if($rows['author']!='admin'||$rows['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a href="memberlist.php?mode=viewprofile&username='.$rows['author'].'" style="color: #AA0000;" class="username-coloured">'; echo $rows['author']; if($rows['author']!='admin'||$rows['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?></strong>
																		&nbsp;| Commentaires: <strong><?php echo mysqli_num_rows($rs3); ?></strong>
																	</div>
																</div>
															</dt>
															<dd style="margin-left: 95px;" class="posts"><?php echo mysqli_num_rows($rs3); ?></dd>
															<dd class="lastpost">
																<span>
																	<dfn>Last post</dfn>
																	
																	<span class="lastpostavatar"><img class="avatar" src="<?php $a=mysqli_fetch_assoc($rs2); echo $a['avatar']; ?>" width="30" height="30" title="Photo de Profile" alt="Photo de Profile"></span>
																	par <?php if($rows['author']!='admin'||$rows['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '<a href="memberlist.php?mode=viewprofile&username='.$rows['author'].'" style="color: #AA0000;" class="username-coloured">'; echo $rows['author']; if($rows['author']!='admin'||$rows['author']=='admin'&&isset($_SESSION['username'])&&$_SESSION['username']=='admin') echo '</a>'; ?>
                                                                    <br /><br /><?php echo $rows['date']; ?>
																</span>
															</dd>
														</dl>
													</li>
<?php
			}
		}
?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
<?php
	}
	include 'inclusion/footer';
	exit;
?>