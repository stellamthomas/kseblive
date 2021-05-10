<?php
    session_start();
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

    $mail->IsHTML(true);
    $mailid = $_COOKIE['email'];
    $mail->AddAddress($mailid,$_SESSION['fullname']);

    $mail->SetFrom("otpforfree@gmail.com", "KL-KSEBLive");
    $mail->Subject = "KSEB Complaint Details";

    $k2=$_SESSION['key'];
    $k3=$_SESSION['key1'];

    $content = "Your Complaint Id is <b>".$k2."</b> and Phone number is <b>".$k3."</b>";

    $_SESSION['email'] = $mailid;

    $mail->MsgHTML($content);
    if(!$mail->Send())
    {
      //echo "Error while sending Email.";
      //var_dump($mail);
    }
    else
    {
      echo "<script>alert('Complaint Id is sent to your registered email.');window.location.href='customerhome.php';</script>";
    }
?>
