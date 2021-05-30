<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
	include 'connection.php';
    include 'lmheader.php';
    include 'lmmainhome.php';
    include 'lmfooter.php';
 }
  else
  {
	Header("location:../index.php");
  }
?>