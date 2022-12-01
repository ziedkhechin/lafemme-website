<?php
	session_start();
	include "connectDB.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>PROTECH</title>
<?php
	include 'inclusion/header';
?>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<div id="forumlist_collapse">
									<div>
<?php
	if(isset($_SESSION['username']))
	{
?>
										<div class="forabg">
											<div class="inner">
												<ul class="topiclist forumbg alt_block">
													<li class="header">
														<dl class="row-item">
															<dt><div class="list-inner">Nouveau poste</div></dt>
														</dl>
													</li>
												</ul>
												<div class="collapse-trigger" aria-expanded="false">
													<a href="#">
														<span class="icon fa-minus tooltip-left tooltipstered"></span>
														<span class="icon fa-plus tooltip-left tooltipstered"></span>
													</a>
												</div>
												<ul class="topiclist forums">
													<div class="row has_last_post_avatar">
													<form style="margin: 22px 0 22px 10px;" method="post" action="posting.php?mode=post"">
														<input required name="subject" class="inputbox" style="height: 33px; width: 62%; border-color: #edecec; background-color: #FFFFFF;" placeholder="Ecrire le titre de votre sujet" type="text" maxlength="65" />
														<select required name="category" style="margin-left: 2%; height: 33px; width: 34.6%; border-color: #edecec; background-color: #FFFFFF; color: #333333;">
															<option selected label="Sélectionner un catégorie"></option>
<?php
		$rq1="SELECT * FROM category";
		$rs1=mysqli_query($con,$rq1);
		while($rows1=mysqli_fetch_assoc($rs1))
		{
			echo '															<option value="'.$rows1['id_cat'].'">'.$rows1['name'].'</option>';
		}
?>
														</select><br /><br />
														<textarea required type="text" placeholder="Exprimez-vous" rows="7" class="inputbox" style="width: 97.5%; border-color: #edecec; background-color: #FFFFFF; color: #333333;" maxlength="2000" name="text"></textarea>
														<input type="hidden" name="date_cur" id="date_cur" /><br /><br />
														<script>
															var d=new Date;
															document.getElementById('date_cur').value=d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+" "+d.getDate()+"-"+(d.getMonth()+1)+"-"+d.getFullYear();
														</script>
														<input class="button1 default-submit-action" id="submit" name="submit" type="submit" value="Publier">
													</form>
													</div>
												</ul>
											</div>
										</div>
<?php
	}
?>
										<div class="forabg">
											<div class="inner">
												<ul class="topiclist">
													<li class="header">
														<dl class="row-item">
															<dt><div class="list-inner"><a href="viewforum.php">Dernière Activités</a></div></dt>
															<dd style="margin-left: 95px;" class="posts"><span class="icon fa-comments" title="Commentaires"></span></dd>
															<dd class="lastpost"><span><span class="icon fa-clock-o"></span></span></dd>
														</dl>
													</li>
												</ul>
												<div class="collapse-trigger open">
													<a href="#">
														<span class="icon fa-minus tooltip-left tooltipstered"></span>
														<span class="icon fa-plus tooltip-left tooltipstered"></span>
													</a>
												</div>
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
		$x=0;
		while($rows1=mysqli_fetch_assoc($rs1))
		{
			$x++;
			if($x>7)
				break;
			$rq3="SELECT id_c FROM comments c, posts p WHERE c.id_p=p.id_p AND p.id_p=".$rows1['id_p'];
			$rq4="SELECT name FROM category cat, posts p WHERE cat.id_cat=p.category AND p.id_p=".$rows1['id_p'];
			$rs3=mysqli_query($con,$rq3);
			$rs4=mysqli_query($con,$rq4);
            $avatar=getAvatar($con, $rows1['author']);
			
?>
													<li class="row has_last_post_avatar">
														<dl class="row-item forum_read">           
															<dt>
																<div class="list-inner">
																	<a href="viewforum.php?id=<?php echo $rows1['id_p']; ?>" class="forumtitle"><?php echo $rows1['title']; ?></a>
																	<br /><span class="forum_description"><a href="viewforum.php?category=<?php echo $rows1['category']; ?>"><?php $name=mysqli_fetch_assoc($rs4); echo $name['name']; ?></a></span>						                                                            
																	<div class="responsive-show responsive_forumlist_row_stats" style="display: none;">
																		Par: <strong><?php echo '<a href="memberlist.php?mode=viewprofile&username='.$rows1['author'].'" style="color: #AA0000;" class="username-coloured">'.$rows1['author'].'</a>'; ?></strong>
																		&nbsp;| Commentaires: <strong><?php echo mysqli_num_rows($rs3); ?></strong>
																	</div>
																</div>
															</dt>
															<dd style="margin-left: 95px;" class="posts"><?php echo mysqli_num_rows($rs3); ?></dd>
															<dd class="lastpost">
																<span>
																	<dfn>Last post</dfn>
																	
																	<span class="lastpostavatar"><img class="avatar" src="<?php echo $avatar; ?>" width="30" height="30" title="Photo de Profile" alt="Photo de Profile"></span>
																	par <?php echo '<a href="memberlist.php?mode=viewprofile&username='.$rows1['author'].'" style="color: #AA0000;" class="username-coloured">'.$rows1['author'].'</a>'; ?>
                                                                    <br /><br /><?php echo $rows1['date']; ?>
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
										<div class="forabg">
											<div class="inner">
												<ul class="topiclist">
													<li class="header">
														<dl class="row-item">
															<dt><div class="list-inner">Catégories de discussion</div></dt>
															<dd style="margin-left: 360px;" title="Nombre de postes" class="posts"><span class="icon fa-book"></span></dd>
														</dl>
													</li>
												</ul>
												<div class="collapse-trigger open">
													<a href="#">
														<span class="icon fa-minus tooltip-left tooltipstered"></span>
														<span class="icon fa-plus tooltip-left tooltipstered"></span>
													</a>
												</div>
												<ul class="topiclist forums">
<?php
	$rq1="SELECT * FROM category";
	$rs1=mysqli_query($con,$rq1);
	if(mysqli_num_rows($rs1)==0)
	{
		echo "Ce bord n'a pas de Catégorie!";
	}
	else
	{
		while($rows1=mysqli_fetch_assoc($rs1))
		{
			$rq2="SELECT id_p FROM posts WHERE category=".$rows1['id_cat'];
			$rs2=mysqli_query($con,$rq2);
?>
													<li class="row has_last_post_avatar">
														<dl>           
															<dt>
																<div style="width: 84%" class="list-inner">
																	<a href="viewforum.php?category=<?php echo $rows1['id_cat']; ?>" class="forumtitle"><?php echo $rows1['name']; ?></a>
																	<br /><span class="forum_description"><?php echo $rows1['description']; ?></span>						                                                            
																	<div class="responsive-show responsive_forumlist_row_stats" style="display: none;">Articles: <strong><?php echo mysqli_num_rows($rs2); ?></strong></div>
																</div>
															</dt>
															<dd style="margin-left: 36.5%;" class="posts"><?php echo mysqli_num_rows($rs2); ?></dd>
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
									<div class="post_forumlist_links"></div>
									<div class="forumbg alt_block">
										<div class="inner">
											<ul class="topiclist">
												<li class="header">
													<dl class="row-item">
														<dt>
														<div class="list-inner">
																<i class="fa fa-line-chart"></i>&nbsp;&nbsp;Informations
															</div>
														</dt>
													</dl>
												</li>
											</ul>
											<ul class="topiclist forums">
<?php
	if(!isset($_SESSION['username']))
	{
?>
												<li class="row responsive-hide stat_login_hide">
													<form action="login.php?mode=login" class="headerspace" method="post">
														<h3><a href="login.php">Login</a>&nbsp; • &nbsp;<a href="register.php">Register</a></h3>
														<fieldset class="quick-login">
															<label for="username"><span>Nom d'utilisateur:</span> <input class="inputbox" id="username" name="username" size="10" tabindex="1" type="text"></label> <label for="password"><span>Mot de passe:</span> <input autocomplete="off" class="inputbox" id="password" name="password" size="10" tabindex="2" type="password"></label> <input class="button2" name="login" tabindex="5" type="submit" value="Connecter">
														</fieldset>
													</form>
												</li>
<?php
	}
	$rq1="SELECT id_p FROM posts";
	$rq2="SELECT id_c FROM comments";
	$rq3="SELECT username FROM members";
	$rs1=mysqli_query($con,$rq1);
	$rs2=mysqli_query($con,$rq2);
	$rs3=mysqli_query($con,$rq3);
?>
												<li class="row">
													<div class="stat-block statistics">
														<h3>Statistiques</h3>
														<p>Total des publications <strong><?php echo mysqli_num_rows($rs1); ?></strong> • Total des commentaires <strong><?php echo mysqli_num_rows($rs2); ?></strong> • Total membres <strong><?php echo mysqli_num_rows($rs3); ?></strong></p>
													</div>
												</li>
											</ul>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
<?php
	include 'inclusion/footer';
?>
