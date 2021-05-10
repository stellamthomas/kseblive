<?php
    session_start();
    include 'connection.php';
    $otp = $_SESSION["otp"];
    $otptext = $_POST["otpget"];
    if($otp == $otptext)
    {
        $sql="update tb_login set otpstatus = '1' where username='".$_SESSION['email']."'";
        $ex1=mysqli_query($conn,$sql);
        echo "<script>alert('Email verification Successfull. Login to Continue...');window.location.replace(\"index.php\");</script>";
    }
    else
    {
        echo "<script>alert('Email verification Failed.');window.location.replace(\"otptest.php\");</script>";
    }

?>