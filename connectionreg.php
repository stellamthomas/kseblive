<?php
    session_start();
	include 'connection.php';

	$lkey = $_COOKIE['lkey'];
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phno = $_POST['phno'];
	$gender = $_POST['gender'];
	$dist = $_POST['district'];
	$pin = $_POST['pincode'];
	$section = $_POST['section'];
	$category = $_POST['category'];
	$aadhar = $_POST['aadhar'];
	$totalloads = $_POST['totalloads'];
	$supplytype = $_POST['supplytype'];
	$filename = $_FILES['aadharfile']["name"];
  $curdate = date('d-m-y');
	$status = 0;
	$k1=md5(microtime());
	$filekey=substr($k1,0,8);

	setcookie("emailid",$email);
	$_SESSION['fullname'] = $firstname." ".$lastname;

	$sql1="insert into tb_connectionreg(
		fname,lname,email,address,gender,
		phno,district,section,pincode,supplytype,
		totalloads,category,aadhar,aadharfile,filekey,curdate,
		status,loginid) values
	('".$firstname."','".$lastname."','".$email."','".$address."','".$gender."','".$phno."','".$dist."','".$section."','".$pin."','".$supplytype."',
	'".$totalloads."','".$category."','".$aadhar."',
	'".$filename."','".$filekey."','".$curdate."','".$status."','".$lkey."')";

    $ex1=mysqli_query($conn,$sql1);

    if($ex1)
  	{
				$path="Uploads/".$filekey;
				mkdir($path);
				move_uploaded_file($_FILES['aadharfile']["tmp_name"],$path."/".$_FILES['aadharfile']["name"]);
				$_SESSION['appid'] = $filekey;
			echo "<SCRIPT type='text/javascript'>alert('New Connection Request Applied Successfully.Check Your Mail For Application Details.');
       window.location.replace(\"connectionmail.php\");
       </SCRIPT>";
  	}
  	else
  	{
      echo "<SCRIPT type='text/javascript'>alert('Connection Request Registration Failed.');
       window.location.replace(\"newconnectionreg.php\");
       </SCRIPT>";
    }

?>
