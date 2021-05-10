<?php 
  session_start();
	include 'connection.php';

    $engkey = $_GET['t'];
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];

	$address = $_POST['address'];
	$phno = $_POST['phno'];
	$gender = $_POST['gender'];
	$dist = $_POST['district'];
	$pin = $_POST['pincode'];
	$section = $_POST['section'];

  $sql2 = "update tb_linemanreg set fname='".$firstname."',lname='".$lastname."',address='".$address."',gender='".$gender."',phno='".$phno."',district='".$dist."'
  ,section='".$section."',pincode='".$pin."' where lmkey='".$engkey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Updation Successfull');window.location.replace(\"viewlineman.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Updation Failed.');window.location.replace(\'editlm.php?t=.$engkey.\');</SCRIPT>";
  }

?>
