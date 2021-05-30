<?php
    session_start();
	include 'connection.php';
	$final = $_POST['final'];
	$current = $_POST['current'];
	$fixcharge = $_POST['fixcharge'];
	$energycharge = $_POST['energycharge'];
	$filename = $_FILES['aadharfile']["name"];

	$unitsused= $current-$final;
  	$total=($unitsused*$energycharge)+$fixcharge;

	$sql = "update tb_bill set finalread ='".$current."',unitsused='".$unitsused."',total='".$total."',meterfile='".$filename."',approvestatus='1' where billkey='".$_GET['t']."'";
    $result = mysqli_query($conn,$sql);
    
    $sql = "update tb_noncontactbill set constatus ='2' where conbillkey='".$_GET['t']."'";
    $result = mysqli_query($conn,$sql);

    if($result)
  	{
		$path="Uploads/".$_GET['t'];
		mkdir($path);
		move_uploaded_file($_FILES['aadharfile']["tmp_name"],$path."/".$_FILES['aadharfile']["name"]);
		echo "<SCRIPT type='text/javascript'>alert('Bill Details Uploaded Successfully.');
      	window.location.replace(\"billupload.php\");
       </SCRIPT>";
  	}
  	else
  	{
      echo "<SCRIPT type='text/javascript'>alert('Uploading Failed.');
       window.location.replace(\"billupload.php\");
       </SCRIPT>";
    }

?>
