<?php
    session_start();
    include 'connection.php';
    //https://myaccount.google.com/u/0/lesssecureapps - Turn on less secure apps

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.hostinger.in";

    $filekey = $_SESSION['filekey'];
    $sql="select * from tb_connectionreg where filekey ='".$filekey."'";

      $result = mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_array($result))
      {
        $phno=$row['phno'];
        $conno=$row['conno'];
        $email=$row['email'];
      }

    $mail->IsHTML(true);
    $mail->AddAddress($email,"");
    $mail->SetFrom("ksebotp@kseblive.site", "KL-FREEOTP");
    $mail->Subject = "KSEB New Connection Details - Approved";

   

    $content = "<b><font size='7px' color='grey'>Connection Details</b></font><br><hr><br>Consumer # : ".$conno."<br>Phone # : ".$phno."<br><br><br><hr> <font size='5px' color='green'>New Connection Approved - KSEBLive</font><br><br><font size='3px' color='grey'>DON'T REPLY TO THIS EMAIL - KSEBLIVE 2021</font>";



    $mail->MsgHTML($content);
    if(!$mail->Send())
    {
      //echo "Error while sending Email.";
      //var_dump($mail);
    }
    else
    {
      echo "<script>alert('Connection Details Sent To Registered Email ID.');window.location.href='viewrequests.php';</script>";
    }
?>
