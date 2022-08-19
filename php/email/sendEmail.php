<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl){
  $requestUri = $_SERVER['REQUEST_URI'];
  $sender = 'jamesphpcoding@gmail.com';
  if (str_contains($requestUri, 'loginReg/') || str_contains($requestUri, 'setting/account') ) {
    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';
  } else{
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
  }

  try {
    $mail = new PHPMailer();
    $mail->isSMTP(true);
    $mail->Host='smtp.gmail.com';
    $mail->Port=465;
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth=true;
    $mail->Username=$sender;
    $mail->Password='uqoqfnmunyutrdea';

    $mail->setFrom($sender, 'griefSpace');
    $mail->addAddress($email, $uid);
    $mail->isHTML();
    $mail->Subject=$subject;
    $mail->Body=$body;

    if ($mail->send()) {
      if ($successUrl != null) {
        header($successUrl);
        exit();
      } else{
        return 'success';
        exit();
      }
    }
    else{
      if ($failUrl != null) {
        header($failUrl);
        exit();
      } else{
        return 'failed';
        exit();
      }
    }
  } catch (\Exception $e) {
    // header($failUrl);
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    exit();
  }


}



 ?>
