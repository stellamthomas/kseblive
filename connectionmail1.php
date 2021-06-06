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
    $mail->Host       = "smtp.hostinger.com";

    $mail->IsHTML(true);
    
    $mail->AddAddress($_COOKIE['emailid'],$_SESSION['fullname']);
    $mail->SetFrom("ksebotp@kseblive.site", "KL-KSEBLive");
    $mail->Subject = "KSEB New Connection Details";


       $filekey = $_SESSION['appid'];
    $content = "Your Application for new KSEB connection is successfully submitted and your Application Id is <b>".$filekey."</b>";


    $mail->MsgHTML($content);
    if(!$mail->Send())
    {
      echo "Error while sending Email.";
      //var_dump($mail);
    }
    else
    {
      echo "<script>window.location.href='index.php';</script>";
    }
?>
