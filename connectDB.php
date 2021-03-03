<?php
	$dbHost='127.0.0.1'; //localhost:3306
	$dbUsername='root'; //ncnkmcxd_st_user
	$dbPassword=''; //so-account0login
	$dbName='ncnkmcxd_la_femme_db';
	$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_errno())
	{
		die('Connect Error ('. mysqli_connect_errno().') '.mysqli_connect_error());
	}
	mysqli_set_charset($con,"utf8");
	date_default_timezone_set('Africa/Tunis');
?>