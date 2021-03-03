<?php
	session_start();
	include "connectDB.php";
	if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode']=='post' && isset($_SESSION['username']) && isset($_POST['category']) && isset($_POST['subject']) && isset($_POST['text']) && isset($_POST['date_cur']))
	{
		$rq="INSERT INTO posts (author,category,title,text,date_ls,date) VALUES('".$_SESSION['username']."','".$_POST['category']."','".$_POST['subject']."','".$_POST['text']."','".date("Y-m-d H:i:s")."','".$_POST['date_cur']."')";
		mysqli_query($con,$rq);
		header("Location: index.php");
	}
	else
	if (isset($_REQUEST['mode']) && !empty($_REQUEST['mode']) && $_REQUEST['mode']=='reply' && isset($_SESSION['username']) && isset($_POST['comment']) && isset($_POST['forum_id']) && isset($_POST['date_cur']))
	{
		$rq="INSERT INTO comments (id_p,date_ls,date,author,text) VALUES('".$_POST['forum_id']."','".date("Y-m-d H:i:s")."','".$_POST['date_cur']."','".$_SESSION['username']."','".$_POST['comment']."')";
		mysqli_query($con,$rq);
		header("Location: viewforum.php?id=".$_POST['forum_id']);
	}
	exit;
?>