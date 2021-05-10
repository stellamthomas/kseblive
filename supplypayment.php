<?php
	include 'connection.php';
	$lkey = $_COOKIE['lkey'];
	$key=$_GET['t'];

	$sql="update tb_addsupplyrequest set suppaymentstatus='1' where supkey='".$key."'";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		$paykey=md5(microtime());
  		$paykey=substr($paykey,0,8);

		$sql="insert into tb_addsupplyreport (rpkey,rpdate,rpamt,rpreqkey,loginid) values ('".$paykey."','".date('d-m-y')."','200','".$key."','".$lkey."')";
  		$ex1=mysqli_query($conn,$sql);
		echo "<SCRIPT type='text/javascript'>alert('Payment updated in your section.'); window.location.replace(\"viewaddionalsupplystatus.php\"); </SCRIPT>";
	}
	

?>