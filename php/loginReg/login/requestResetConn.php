<?php

  if (isset($_POST['requestSub'])) {
    $email = $_POST['email'];

    if (empty($email)) {
      header("Location:../../../html/resend/getResetPwdLetter.php?status=empty");
      exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location:../../../html/resend/getResetPwdLetter.php?status=email&email=$email");
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
      header("Location:../../../html/resend/getResetPwdLetter.php?status=error&email=$email");
      exit();
    } elseif (count($userdata) <= 0) {
      header("Location:../../../html/resend/getResetPwdLetter.php?status=nouser&email=$email");
      exit();
    }
    $userId = (int)$userdata[0]['id'];
    $uid = $userdata[0]['uid'];

    $sql = "SELECT * FROM forgetpwd WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();
    $entry = $stmt->fetchAll();
    $currentDate = date("U");
    $expiry = $currentDate + 30*60;

    //generate token
    $hexToken = bin2hex(random_bytes(8));
    $hashtoken = password_hash($hexToken, PASSWORD_DEFAULT);

    //create email elements
    require '../../email/sendEmail.php';
    require '../../emailTemplate/resetEmail.php';
    $subject = getSubject();
    $body = getBody($hexToken);
    $successUrl = "Location:../../../html/resend/getResetPwdLetter.php?request=success";
    $failUrl = "Location:../../../html/resend/getResetPwdLetter.php?request=sendErr&email=$email";

    // check if request exists
    if (count($entry) > 1) {
      header("Location:../../../html/resend/getResetPwdLetter.php?status=error&email=$email");
      exit();
    } elseif (count($entry) <= 0) {
      // no request record, then create request
      $sql = "INSERT INTO forgetpwd(userdata_id, token, expiry) VALUES(?,?,?);";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $userId, PDO::PARAM_INT);
      $stmt->bindParam(2, $hashtoken, PDO::PARAM_STR);
      $stmt->bindParam(3, $expiry, PDO::PARAM_INT);
      $stmt->execute();

      //send reset email
      sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
      exit();

      // has request, check request's time limit
    } elseif (($entry[0]['expiry'] - $currentDate) > 0) {
      header("Location:../../../html/resend/getResetPwdLetter.php?status=timelimit&email=$email");
      exit();
    }

    $sql = "UPDATE forgetpwd
              SET token=?, expiry=?
                WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $hashtoken, PDO::PARAM_STR);
    $stmt->bindParam(2, $expiry, PDO::PARAM_INT);
    $stmt->bindParam(3, $userId, PDO::PARAM_INT);
    $stmt->execute();

    //send reset email
    sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
    exit();


  } else{
    header("Location:../../../html/login.php");
    exit();
  }

 ?>
