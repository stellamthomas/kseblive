<?php
  session_start();
	include 'connection.php';

	$duedate = $_POST['duedate'];
	$dcdate = $_POST['dcdate'];
	$username = $_POST['username'];

	$initread = $_POST['initread'];
	$finalread = 0;


	$fixcharge = $_POST['fixcharge'];
	$energycharge = $_POST['energycharge'];


	$conno = $_POST['conno'];
	$phno = $_POST['phno'];

  $unitsused=0;
  $total=0;


	$status = 0;
  $curdate = date('Y-m-d');

  $staffid=$_COOKIE['lkey'];
  $engid = $_POST['engid'];

  $date=date("d M Y");
  //echo $date;exit;


  $engkey=md5(microtime());
  $billkey=substr($engkey,0,8);

  $sql5="insert into tb_noncontactbill(curdate,conbillkey,conno,username,constatus) values ('".$date."','".$billkey."','".$conno."','".$username."','0')";
  //echo $sql5;exit;
  $ex3=mysqli_query($conn,$sql5);

	$sql2="insert into tb_bill(billkey,billdate,duedate,dcdate,initialread,finalread,unitsused,fixedcharge,energycharge,total,consumerno,phno,status,staffid,engid,nonstatus) values
	('".$billkey."','".$curdate."','".$duedate."','".$dcdate."','".$initread."','".$finalread."','".$unitsused."','".$fixcharge."','".$energycharge."','".$total."','".$conno."','".$phno."','".$status."','".$staffid."','".$engid."','1')"; //echo $sql2;exit;

  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
     echo "<SCRIPT type='text/javascript'>alert('Bill Added.');window.location.replace(\"viewnonbills.php\");</SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Bill Updation Failed.');window.location.replace(\"noncontactbills.php\");</SCRIPT>";
  }

?>
