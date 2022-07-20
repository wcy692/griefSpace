<?php

  if (isset($_POST['actSub'])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $token = $_POST['token'];

    if (empty($uid) || empty($pwd)) {
      header("Location:../../../html/activationPage.php?status=empty&uid=$uid&token=$token");
      exit();
    }

    require_once '../../dbConn.php';
    $pdo = pdoConn();

    // check if username registered
    $sql = "SELECT * FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (count($row) > 1) {
      header("Location:../../../html/activationPage.php?status=error&uid=$uid&token=$token");
      exit();
    } elseif (count($row) <= 0) {
      header("Location:../../../html/activationPage.php?status=nouser&uid=$uid&token=$token");
      exit();
    }

    // check if user's request exists
    $sql = "SELECT * FROM activation JOIN userdata ON activation.userdata_id=userdata.id AND uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $currentDate = date("U");

    if (count($row) > 1) {
      header("Location:../../../html/activationPage.php?status=error&uid=$uid&token=$token");
      exit();
    } elseif (count($row) <= 0) {
      header("Location:../../../html/activationPage.php?status=norequest&uid=$uid&token=$token");
      exit();
    } elseif (!password_verify($pwd, $row[0]['pwd'])) {
      header("Location:../../../html/activationPage.php?status=wrongpwd&uid=$uid&token=$token");
      exit();
    } elseif (!password_verify($token, $row[0]['token'])) {
      header("Location:../../../html/activationPage.php?status=token");
      exit();
      exit();
    } elseif ($currentDate > $row[0]['expiry']) {
      header("Location:../../../html/activationPage.php?status=expiry");
      exit();
    }
    $idNum = (int)$row[0]['userdata_id'];
    $email = $row[0]['email'];


    // update isActivate as true
    $sql = "UPDATE userdata
              SET isActivate=1
              WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();

    // delete this user request from activation table
    $sql = "DELETE FROM activation WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $idNum, PDO::PARAM_INT);
    $stmt->execute();

    //send activation email
    require '../../email/sendEmail.php';
    require '../../emailTemplate/goodActEmail.php';
    $subject = getSubject();
    $body = getBody();
    $successUrl = "Location:../../../html/activationPage.php?activate=success";
    $failUrl = "Location:../../../html/activationPage.php?activate=sendErr";
    sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
    exit();

  } else{
    header("Location:../../../html/login.php");
    exit();
  }

 ?>
