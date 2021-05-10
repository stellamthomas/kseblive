<?php
  session_start();
	include 'connection.php';

	$duedate = $_POST['duedate'];
	$dcdate = $_POST['dcdate'];

	$initread = $_POST['initread'];
	$finalread = $_POST['finalread'];


	$fixcharge = $_POST['fixcharge'];
	$energycharge = $_POST['energycharge'];


	$conno = $_POST['conno'];
	$phno = $_POST['phno'];

  $unitsused= $finalread-$initread;
  $total=($unitsused*$energycharge)+$fixcharge;


	$status = 0;
  $curdate = date('Y-m-d');

  $staffid=$_COOKIE['lkey'];
  $engid = $_POST['engid'];


  $engkey=md5(microtime());
  $billkey=substr($engkey,0,10);


	$sql2="insert into tb_bill(billkey,billdate,duedate,dcdate,initialread,finalread,unitsused,fixedcharge,energycharge,total,consumerno,phno,status,staffid,engid) values
	('".$billkey."','".$curdate."','".$duedate."','".$dcdate."','".$initread."','".$finalread."','".$unitsused."','".$fixcharge."','".$energycharge."','".$total."','".$conno."','".$phno."','".$status."','".$staffid."','".$engid."')"; //echo $sql2;exit;

  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
     echo "<SCRIPT type='text/javascript'>alert('Bill Added.');window.location.replace(\"viewbills.php\");</SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Bill Updation Failed.');window.location.replace(\"addbills.php\");</SCRIPT>";
  }

?>
