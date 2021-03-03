<?php
	session_start();
	include "connectDB.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>Paramétres • LA FEMME</title>
<?php
	if(!isset($_SESSION['username']))
		header("Location: login.php");
		else
		{
			include 'inclusion/header';
?>
			<ul class="nav-breadcrumbs linklist navlinks" id="nav-breadcrumbs" role="menubar">
				<li class="breadcrumbs" style="max-width: 5049px;"><span class="crumb"><a accesskey="h" href="index.php"><i class="icon fa-home fa-fw"></i><span>Accueil</span></a></span><span class="crumb"><span>Administration</span></span></li>
			</ul>
			<div class="page-body" id="page-body" role="main">
				<div id="maincontainer">
					<div id="contentwrapper">
						<div id="contentcolumn">
							<div class="innertube">
								<h2 class="ucp-title">Administration</h2>
								<div id="tabs" class="tabs">
									<ul>
										<li class="tab"><a href="./ucp.php?i=177">Overview</a></li>
										<li class="tab"><a href="./ucp.php?i=178">Profile</a></li>
										<li class="tab"><a href="./ucp.php?i=179">Board preferences</a></li>
										<li class="tab"><a href="./ucp.php?i=ucp_pm">Private messages</a></li>
										<li class="tab activetab"><a href="./ucp.php?i=181">Usergroups</a></li>
										<li class="tab"><a href="./ucp.php?i=182">Friends &amp; Foes</a></li>
										<li class="tab responsive-tab dropdown-container" style="display:none;"><a href="javascript:void(0);" class="responsive-tab-link dropdown-toggle">&nbsp;</a><div class="dropdown tab-dropdown" style="display: none;"><div class="pointer"><div class="pointer-inner"></div></div><ul class="dropdown-contents"></ul></div></li>
									</ul>
								</div>
								<div class="panel bg3">
									<div class="inner">
										<div style="width: 100%;">
											<div id="cp-menu" class="cp-menu">
												<div id="navigation" class="navigation" role="navigation">
													<ul>
														<li id="active-subsection" class="active-subsection"><a href="./ucp.php?i=ucp_groups&amp;mode=membership"><span>Edit memberships</span></a></li>
														<li><a href="./ucp.php?i=ucp_groups&amp;mode=manage"><span>Manage groups</span></a></li>
													</ul>
												</div>
											</div>
											<div id="cp-main" class="cp-main ucp-main panel-container">
												<h2>Groups</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
<?php
			include 'inclusion/footer';
		}
	exit;
?>