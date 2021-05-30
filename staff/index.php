<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
	include 'connection.php';
    include 'staffheader.php';
    include 'staffmainhome.php';
    include 'stafffooter.php';
  }
  else
  {
	Header("location:../index.php");
  }
?>