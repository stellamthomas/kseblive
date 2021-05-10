<?php
    session_start();
	include 'connection.php';

	$key=$_GET['t'];
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

	$sql="UPDATE `tb_connectionreg` SET `fname`='".$firstname."',`lname`='".$lastname."',`email`='".$email."',`address`='".$address."',`gender`='".$gender."',`phno`='".$phno."',`district`='".$dist."',`section`='".$section."',`pincode`='".$pin."',`supplytype`='".$supplytype."',`totalloads`='".$totalloads."',`category`='".$category."',`aadhar`='".$aadhar."',`aadharfile`='".$filename."',`status`='".$status."',`filekey`='".$filekey."' WHERE filekey='".$key."'";


    $ex1=mysqli_query($conn,$sql);

    if($ex1)
  	{
				$path="Uploads/".$filekey;
				mkdir($path);
				move_uploaded_file($_FILES['aadharfile']["tmp_name"],$path."/".$_FILES['aadharfile']["name"]);
				$_SESSION['appid'] = $filekey;
			echo "<SCRIPT type='text/javascript'>alert('New Connection Details Updated Successfully And Mailed To Registered Mail ID.');
       window.location.replace(\"connectionmail1.php\");
       </SCRIPT>";
  	}
  	else
  	{
      echo "<SCRIPT type='text/javascript'>alert('Connection Request Registration Failed.');
       window.location.replace(\"publicnewconnection.php\");
       </SCRIPT>";
    }

?>
