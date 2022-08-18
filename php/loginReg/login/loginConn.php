<?php

  if (isset($_POST['loginSub'])) {
    $emailUid = $_POST['emailUid'];
    $pwd = $_POST['pwd'];

    if(empty($emailUid) || empty($pwd)){
      header("Location: ../../../html/loginPage.php?status=empty&emailUid=$emailUid");
      exit();
    }

    require_once '../../dbConn.php';
    $pdo = pdoConn();

    $sql = "SELECT * FROM userdata WHERE email=? OR uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $emailUid, PDO::PARAM_STR);
    $stmt->bindParam(2, $emailUid, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 1) {
      header("Location: ../../../html/loginPage.php?status=error&emailUid=$emailUid");
      exit();
    } elseif (count($result) <= 0) {
      header("Location: ../../../html/loginPage.php?status=nouser&emailUid=$emailUid");
      exit();
    } elseif (!password_verify($pwd, $result[0]['pwd'])){
      header("Location: ../../../html/loginPage.php?status=wrongpwd&emailUid=$emailUid");
      exit();
    }
    $userdata_id = (int)$result[0]['id'];
    $uid = $result[0]['uid'];
    $email = $result[0]['email'];

    // get login_alert setting
    $sql = "SELECT login_alert, one_time_pwd FROM user_notification WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $login_alert = $result[0]['login_alert'];
    $is_one_time_pwd = $result[0]['one_time_pwd'];

    session_start();
    session_unset();

    if ($is_one_time_pwd == 1) {
      //generate 6-digit token and expiry
      $token = mt_rand(100000,999999);
      $hashtoken = password_hash($token, PASSWORD_DEFAULT);

      //delete otp attempt from same userdata_id
      $sql = "DELETE FROM otp_email WHERE userdata_id=?;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
      $stmt->execute();

      // insert into otp_email table to store one-time password in hashed format
      $sql = "INSERT INTO otp_email(userdata_id, token) VALUES(?,?);";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
      $stmt->bindParam(2, $hashtoken, PDO::PARAM_STR);
      $stmt->execute();

      //generat temp session to allow validation from optChannel
      $_SESSION['tempUid'] = $uid;
      $_SESSION['tempLoginAlert'] = $login_alert;

      //send otp email
      require '../../email/sendEmail.php';
      require '../../emailTemplate/otpEmail.php';
      $subject = getSubject();
      $body = getBody($token);
      $successUrl = "Location: ../../../html/login/otpChannel.php";
      $failUrl = "Location: ../../../html/loginPage.php?alert=sendErr";
      sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
      exit();
    }


    // create session
    $_SESSION['uid'] = $uid;

    if ($login_alert == 1) {
      //create date timestamp
      $dateTime = new DateTime();
      $current = $dateTime->format("Y-m-d H:i:s");
      $tz = $dateTime->getTimeZone();
      $tzName = $tz->getName();

      //send alert email
      require '../../email/sendEmail.php';
      require '../../emailTemplate/loginAlertEmail.php';
      $subject = getSubject();
      $body = getBody($current, $tzName);
      $successUrl = "Location: ../../../html/loginPage.php?login=success";
      $failUrl = "Location: ../../../html/loginPage.php?status=sendErr";
      sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
    } else{
      header("Location: ../../../html/loginPage.php?login=success");
    }
    exit();

  } else{
    header("Location: ../../../html/loginPage.php");
    exit();
  }

 ?>
