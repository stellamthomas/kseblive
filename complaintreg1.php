<?php
  session_start();
	include 'connection.php';

	$name = $_POST['fname'];
	$section = $_POST['section'];
	$type = $_POST['comtype'];
	$phno = $_POST['phno'];
	$desc = $_POST['comdesc'];
	$status = 0;
  $k1=md5(microtime());
  $k2=substr($k1,0,8);

	$_SESSION['fullname'] = $name;


	$sql1="insert into tb_complaints(name,section,comtype,phno,comdesc,trackid,curdate,loginid) values ('".$name."','".$section."','".$type."','".$phno."','".$desc."','".$k2."','".date('Y-m-d')."','".$_COOKIE['lkey']."')";
  $ex1=mysqli_query($conn,$sql1);

  if($ex1)
	{
		$_SESSION['key'] = $k2;
		$_SESSION['key1'] = $phno;
    echo "<SCRIPT type='text/javascript'>alert('Complaint Registration Successfull - Complaint ID : $k2 - Save this for future reference');
     window.location.replace(\"complaintmail.php?t='.$k2.'\");
     </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Complaint Registration Failed');
     window.location.replace(\"complaintreg.php\");
     </SCRIPT>";
  }

?>
