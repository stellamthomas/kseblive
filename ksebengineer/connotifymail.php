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
    $mail->Host       = "smtp.gmail.com";

    $key=$_GET['t'];
    $sql = "select * from tb_connotify where connotkey='".$key."'"; //echo $sql;exit;
    $result = mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($result))
    {
        $desc=$row['connotdesc'];
        $conno=$row['conno'];
    }

    $sql = "select * from tb_connectionreg where conno='".$conno."'"; //echo $sql;exit;
    $result = mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($result))
    {
        $email=$row['email'];
    } //echo $email;exit;

    $mail->IsHTML(true);
    $mail->AddAddress($email,"");
    $mail->SetFrom("otpforfree@gmail.com", "KL-FREEOTP");
    $mail->Subject = "KSEBLive - Notification";

   

    $content = "<b><font color='grey' size='4px'>KSEBLive Notification</font></b><br><hr><br>".$desc."<br><br><hr><font color='red' size='1px'>DON'T REPLY TO THIS EMAIL - KSEBLIVE</font> <br>";



    $mail->MsgHTML($content);
    if(!$mail->Send())
    {
      //echo "Error while sending Email.";
      //var_dump($mail);
    }
    else
    {
      echo "<script>window.location.href='viewconsumernotify.php';</script>";
    }
?>
