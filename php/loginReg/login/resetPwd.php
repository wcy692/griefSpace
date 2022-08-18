<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  if (isset($_POST['resetSub'])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $confirmPwd = $_POST['confirmPwd'];
    $token = $_POST['token'];

    //input handler
    if(empty($uid) || empty($pwd) || empty($confirmPwd)){
      header("Location: ../../../html/resetPwdPage.php?status=empty&uid=$uid&token=$token");
      exit();
    } else if(preg_match('/\s/', $pwd)){
      header("Location: ../../../html/resetPwdPage.php?status=whitespace&uid=$uid&token=$token");
      exit();
    } else if($confirmPwd != $pwd){
      header("Location: ../../../html/resetPwdPage.php?status=confirmpwd&uid=$uid&token=$token");
      exit();
    } else if(strlen($pwd) < 8){
      header("Location: ../../../html/resetPwdPage.php?status=pwdlen&uid=$uid&token=$token");
      exit();
    } else if(!preg_match('/\d/', $pwd)){
      header("Location: ../../../html/resetPwdPage.php?status=pwdDigit&uid=$uid&token=$token");
      exit();
    } else if(!preg_match('/[A-Z]/', $pwd)){
      header("Location: ../../../html/resetPwdPage.php?status=pwdUpper&uid=$uid&token=$token");
      exit();
    } else if(!preg_match('/[a-z]/', $pwd)){
      header("Location: ../../../html/resetPwdPage.php?status=pwdLower&uid=$uid&token=$token");
      exit();
    } else if(!preg_match('/\W/', $pwd)){
      header("Location: ../../../html/resetPwdPage.php?status=pwdSpecial&uid=$uid&token=$token");
      exit();
    }

    require_once '../../dbConn.php';
    $pdo = pdoConn();

    $sql = 'SELECT * FROM userdata WHERE uid=?;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $userdata = $stmt->fetchAll();

    if (count($userdata) > 1) {
      header("Location:../../../html/resetPwdPage.php?status=error&uid=$uid&token=$token");
      exit();
    } elseif (count($userdata) <= 0) {
      header("Location: ../../../html/resetPwdPage.php?status=nouser&uid=$uid&token=$token");
      exit();
    }

    $userId = (int)$userdata[0]['id'];
    $email = $userdata[0]['email'];

    $sql = 'SELECT * FROM forgetpwd WHERE userdata_id=?;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();
    $entry = $stmt->fetchAll();
    $currentDate = date("U");

    if (count($entry) > 1) {
      header("Location:../../../html/resetPwdPage.php?status=error&uid=$uid&token=$token");
      exit();
    } elseif (count($entry) <= 0) {
      header("Location: ../../../html/resetPwdPage.php?status=norequest&uid=$uid&token=$token");
      exit();
    } elseif ($currentDate > $entry[0]['expiry']) {
      header("Location: ../../../html/resetPwdPage.php?status=expiry");
      exit();
    } elseif (!password_verify($token, $entry[0]['token'])) {
      header("Location: ../../../html/resetPwdPage.php?status=token");
      exit();
    }

    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    // update password
    $sql = "UPDATE userdata
              SET pwd=?
              WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $hashpwd, PDO::PARAM_STR);
    $stmt->bindParam(2, $uid, PDO::PARAM_STR);
    $stmt->execute();

    // delete this user request from forgetpwd table
    $sql = "DELETE FROM forgetpwd WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    //logout and destroy session
    session_start();
    session_unset();
    session_destroy();

    //send activation email
    require '../../email/sendEmail.php';
    require '../../emailTemplate/goodResetEmail.php';
    $subject = getSubject();
    $body = getBody();
    $successUrl = "Location: ../../../html/resetPwdPage.php?reset=success";
    $failUrl = "Location: ../../../html/resetPwdPage.php?reset=sendErr";
    sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);

    exit();

  } else{
    header("Location: ../../../html/loginPage.php");
    exit();
  }


 ?>
