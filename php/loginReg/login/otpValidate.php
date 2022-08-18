<?php
  session_start();
  if (isset($_POST['otpSub']) && isset($_SESSION['tempUid'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];
    $num4 = $_POST['num4'];
    $num5 = $_POST['num5'];
    $num6 = $_POST['num6'];
    $tempUid = trim($_SESSION['tempUid']);

    // avoid to use empty() as 0 will be considered to be empty
    if (!is_numeric($num1) || !is_numeric($num2) || !is_numeric($num3) || !is_numeric($num4) || !is_numeric($num5) || !is_numeric($num6)) {
      header("Location:../../../html/login/otpChannel.php?status=number");
      exit();
    }
    $numStr = $num1 . $num2 . $num3 . $num4 . $num5 . $num6;

    require_once '../../dbConn.php';
    $pdo = pdoConn();
    $sql = "SELECT uid, id, email FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $tempUid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (count($row) != 1) {
      header("Location:../../../html/loginPage.php?status=error");
      exit();
    }
    $userdata_id = (int)$row[0]['id'];
    $uid = $row[0]['uid'];
    $email = $row[0]['email'];

    $sql = "SELECT token FROM otp_email WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (count($row) != 1) {
      header("Location:../../../html/loginPage.php?status=error");
      exit();
    } else if (!password_verify($numStr, $row[0]['token'])) {
      header("Location:../../../html/login/otpChannel.php?status=wrongpwd");
      exit();
    }
    //delete otp attempt from this userdata_id
    $sql = "DELETE FROM otp_email WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->execute();

    $login_alert = $_SESSION['tempLoginAlert'];
    session_unset();
    $_SESSION['uid'] = $uid;

    if($login_alert == 1){
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
      exit();
    }

  } else{
    echo "Location: ../../../index.php";
    exit();
  }

 ?>
