<?php
 	include 'connection.php';
  	session_start();
	if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
	{
		include 'custheader.php';
		include 'cust404.php';
		include 'mainfooter.php';
	}
	else
	{
		Header("location:index.php");
	}
?>