<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'engheader.php';
  include 'engmainhome.php';
  include 'engfooter.php';
  }
  else
  {
	Header("location:../index.php");
  }
?>