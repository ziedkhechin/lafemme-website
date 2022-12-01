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

    function getAvatar($con, $username) {
        $rq1="SELECT sex, role FROM members WHERE username='$username'";
        $rs1=mysqli_query($con,$rq1);
        $row1=mysqli_fetch_assoc($rs1);

        switch ($row1['role']) {
            case 'admin':
                return "images/admin_avatar.svg";
            case 'user':
                if ($row1['sex'] === 'm') {
                    return "images/male_avatar.svg";
                } else {
                    return "images/female_avatar.svg";
                }
            case 'doctor':
                return "images/doctor_avatar.svg";
        }
    }
