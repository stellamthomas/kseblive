<?php
	session_start();
	unset($_SESSION["logined"]);
	setcookie("logined",0);
	header("Location:../index.php")
?>

