<?php
    session_start();
    include 'connection.php';
    if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
    { 
	    include 'custheader.php';
	    include 'custbody.php';
	    include 'mainfooter.php';
	}
	else
	{
		Header("location:index.php");
	}
?>