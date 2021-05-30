<?php
  session_start();
	include 'connection.php';

	$section = $_POST['section'];
	$type = $_POST['comtype'];
	$desc = $_POST['comdesc'];
	$status = 0;
  	$k1=md5(microtime());
 	 $k2=substr($k1,0,8);



	$sql1="insert into tb_complaints(section,comtype,comdesc,cutype,trackid,curdate,loginid) values ('".$section."','".$type."','".$desc."','1','".$k2."','".date('Y-m-d')."','".$_COOKIE['lkey']."')";
  $ex1=mysqli_query($conn,$sql1);

  if($ex1)
	{
    echo "<SCRIPT type='text/javascript'>alert('Complaint Registration Successfull');
     window.location.replace(\"customerhome.php\");
     </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Complaint Registration Failed');
     window.location.replace(\"complaintreg.php\");
     </SCRIPT>";
  }

?>
