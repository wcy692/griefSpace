<?php

  session_start();
  if (isset($_SESSION['uid'])) {
    $uid = trim($_SESSION['uid']);
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if (empty($email) || empty($pwd)) {
      header("Location:../../../html/setting/changeEmail.php?status=empty&email=$email");
      exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../../../html/setting/changeEmail.php?status=email&email=$email");
      exit();
    }

    require_once '../../dbConn.php';
    $pdo = pdoConn();
    $sql = "SELECT pwd, id FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (!password_verify($pwd, $row[0]['pwd'])) {
      header("Location: ../../../html/setting/changeEmail.php?status=wrongpwd&email=$email");
      exit();
    }

    $id = (int)$row[0]['id'];
    $sql = 'UPDATE userdata
              SET email=?
              WHERE id=?;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $id, PDO::PARAM_INT);
    $stmt->execute();

    //send activation email
    require '../../email/sendEmail.php';
    require '../../emailTemplate/changeEmail.php';
    $subject = getSubject();
    $body = getBody();
    $successUrl = "Location: ../../../html/setting/setting.php?email=success";
    $failUrl = "Location: ../../../html/setting/setting.php?status=sendErr";
    sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
    exit();

  } else{
    header("Location:../../../html/loginPage.php");
    exit();
  }

 ?>
