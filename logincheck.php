<?php
session_start();
    include 'connection.php';

    $usr=$_POST["email"];
    $en=md5($_POST["pass"]);

    $sql="select id,status,utype,otpstatus from tb_login where username='".$usr."' and password='".$en."'";
	$_SESSION['emailid'] = $usr;

    $result = mysqli_query($conn,$sql);
	$a=0;
	while ($row=mysqli_fetch_array($result))
	{
		$a++;
		$b=$row['id'];
		$c=$row['utype'];
		$d=$row['status'];
		$e=$row['otpstatus'];

	}
  if($a>0)
	{
		if($d==1)
		{
			setcookie("lkey",$b);
			setcookie("email",$usr);
			setcookie("logined",1);
			if ($c==0)
			{
				
				header("location:admin/adminhome.php");
			}
			else if($c==1)
			{
				if($e==1)
				{
					header("location:customerhome.php");
				}
				else
				{
					$_SESSION['emailtoverify'] = $usr;
					echo "<SCRIPT type='text/javascript'>alert('Email Verification Pending.....!!');window.location.replace(\"mail.php\");</SCRIPT>";
				}
			}
			else if($c==2)
			{
				header("location:ksebengineer/index.php");
			}
			else if($c==3)
			{
				header("location:staff/index.php");
			}
			else
			{
				header("location:lineman/index.php");
			}
		}
		else if ($d==2)
	  {
	    	echo "<SCRIPT type='text/javascript'>alert('Rejected by Admin.....!!'); window.location.replace(\"index.php\"); </SCRIPT>";
	  }
	  else
		{
        echo "<SCRIPT type='text/javascript'>alert('Approval Pending.....!!');window.location.replace(\"index.php\"); </SCRIPT>";
		}
	}
	else
	{
    	echo "<SCRIPT type='text/javascript'>alert('Invalid User.....!!');
        window.location.replace(\"index.php\");
        </SCRIPT>";
	}

?>
