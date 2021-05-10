<?php
	include 'connection.php';
	$lkey = $_COOKIE['lkey'];
	$key=$_GET['t'];

	$sql="select * from tb_bill where billkey='".$key."'";
	$result = mysqli_query($conn,$sql);
	while ($row=mysqli_fetch_array($result))
	{
		$billamt=$row['total'];
		$conno=$row['consumerno'];
		$phno=$row['phno'];
	}

	$sql="update tb_bill set status='1' where billkey='".$key."'";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		$paykey=md5(microtime());
  		$paykey=substr($paykey,0,10);
		$sql="insert into tb_billpayreport (paykey,paydate,payamt,payconno,payphno,paybillkey,loginid) values ('".$paykey."','".date('d-m-y')."','".$billamt."','".$conno."','".$phno."','".$key."','".$lkey."')";
  		$ex1=mysqli_query($conn,$sql);
		echo "<SCRIPT type='text/javascript'>alert('Payment updated in your section.'); window.location.replace(\"custbillview.php\"); </SCRIPT>";
	}
	

?>