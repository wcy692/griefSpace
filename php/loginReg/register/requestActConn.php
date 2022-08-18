<?php

  if (isset($_POST['requestSub'])) {
    $email = $_POST['email'];

    if (empty($email)) {
      header("Location:../../../html/resend/getActivationLetter.php?status=empty");
      exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location:../../../html/resend/getActivationLetter.php?status=email&email=$email");
      exit();
    }

    require '../../dbConn.php';
    $pdo = pdoConn();
    $sql = "SELECT * FROM userdata WHERE email=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->execute();
    $userdata = $stmt->fetchAll();

    if (count($userdata) > 1) {
      header("Location:../../../html/resend/getActivationLetter.php?status=error&email=$email");
      exit();
    } elseif (count($userdata) <= 0) {
      header("Location:../../../html/resend/getActivationLetter.php?status=nouser&email=$email");
      exit();
    }
    $userId = (int)$userdata[0]['id'];

    $sql = "SELECT * FROM activation WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();
    $activation = $stmt->fetchAll();
    $currentDate = date("U");
    $expiry = $currentDate + 30*60;

    if (count($activation) > 1) {
      header("Location:../../../html/resend/getActivationLetter.php?status=error&email=$email");
      exit();
    } elseif (count($activation) <= 0) {
      header("Location:../../../html/resend/getActivationLetter.php?status=norequest&email=$email");
      exit();
    } elseif (($activation[0]['expiry'] - $currentDate) > 0) {
      header("Location:../../../html/resend/getActivationLetter.php?status=timelimit&email=$email");
      exit();
    }

    //generate token
    $hexToken = bin2hex(random_bytes(8));
    $hashtoken = password_hash($hexToken, PASSWORD_DEFAULT);

    $sql = "UPDATE activation
              SET token=?, expiry=?
                WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $hashtoken, PDO::PARAM_STR);
    $stmt->bindParam(2, $expiry, PDO::PARAM_INT);
    $stmt->bindParam(3, $userId, PDO::PARAM_INT);
    $stmt->execute();


    //send activation email
    require '../../email/sendEmail.php';
    require '../../emailTemplate/actEmail.php';
    $subject = getSubject();
    $body = getBody($hexToken);
    $successUrl = "Location:../../../html/resend/getActivationLetter.php?request=success";
    $failUrl = "Location:../../../html/resend/getActivationLetter.php?request=sendErr&email=$email";
    sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
    exit();


  } else{
    header("Location:../../../html/loginPage.php");
    exit();
  }

 ?>
