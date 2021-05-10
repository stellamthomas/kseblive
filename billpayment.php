<?php
	include 'connection.php';

	$key=$_GET['t'];
	$cno=$_POST['cno'];
	$expdate=$_POST['expdate'];
	$cvc=$_POST['cvc'];
	$cuname=$_POST['cuname'];

	$flag1=0;
	$sql="select * from tb_card where cno='".$cno."'";
	$result = mysqli_query($conn,$sql);
	while ($row=mysqli_fetch_array($result))
	{
		$flag1=1;
		$availamount=$row['cbal'];
	}

	if($flag1==0)
	{
		echo "<SCRIPT type='text/javascript'>alert('Payment Unsuccessfull [Card Details Invalid]'); window.location.replace(\"billview.php\"); </SCRIPT>";
	}
	else
	{

		$flag2=0;
		$sql="select * from tb_bill where billkey='".$key."'";
		$result = mysqli_query($conn,$sql);
		while ($row=mysqli_fetch_array($result))
		{
			$flag2=1;
			$billamt=$row['total'];
			$conno=$row['consumerno'];
			$phno=$row['phno'];
		}

		$availamount=$availamount-$billamt;
		$sql="update tb_card set cbal='".$availamount."' where cno='".$cno."'";
		$result = mysqli_query($conn,$sql);

		$sql="update tb_bill set status='1' where billkey='".$key."'";
		$result = mysqli_query($conn,$sql);

		if($result)
		{
			$paykey=md5(microtime());
	  		$paykey=substr($paykey,0,10);
			$sql="insert into tb_billpayreport (paykey,paydate,payamt,payconno,payphno,paybillkey) values ('".$paykey."','".date('d-m-y')."','".$billamt."','".$conno."','".$phno."',
			'".$key."')";
	  		$ex1=mysqli_query($conn,$sql);
			echo "<SCRIPT type='text/javascript'>alert('Payment Successfull'); window.location.replace(\"billview.php\"); </SCRIPT>";
		}
	}

?>