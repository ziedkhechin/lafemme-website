<?php
	session_start();
	include "connectDB.php";
	if(!isset($_SESSION['username'])||$_SESSION['username']!='admin')
		header("Location: login.php");
		else
		{
?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
	<title>Administration • LA FEMME</title>
<?php
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
												<form id="ucp" method="post" action="./ucp.php?i=ucp_groups&amp;mode=membership">

<div class="panel">
	<div class="inner">

	<p>Usergroups enable board admins to better administer users. By default you will be placed in a specific group, this is your default group. This group defines how you may appear to other users, for example your username colouration, avatar, rank, etc. Depending on whether the administrator allows it you may be allowed to change your default group. You may also be placed in or allowed to join other groups. Some groups may give you additional permissions to view content or increase your capabilities in other areas.</p>
		
			<ul class="topiclist two-columns">
			<li class="header">
				<dl>
					<dt><div class="list-inner with-mark">Memberships</div></dt>
					<dd class="mark">Select</dd>
				</dl>
			</li>
		</ul>
		<ul class="topiclist cplist two-columns">

						<li class="row bg2">
			<dl>
				<dt>
					<div class="list-inner with-mark">
												<a href="./memberlist.php?mode=group&amp;g=7" class="forumtitle">Newly registered users</a>
						<br />This is a special group, special groups are managed by the board administrators.											</div>
				</dt>
				<dd class="mark"><input type="radio" name="selected" value="7" disabled="disabled"></dd>
			</dl>
		</li>
						<li class="row bg1">
			<dl>
				<dt>
					<div class="list-inner with-mark">
												<a href="./memberlist.php?mode=group&amp;g=2" class="forumtitle">Registered users</a>
						<br />This is a special group, special groups are managed by the board administrators.											</div>
				</dt>
				<dd class="mark"><input type="radio" name="selected" value="2" disabled="disabled"></dd>
			</dl>
		</li>
				</ul>
		</div>
</div>
												</form>
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