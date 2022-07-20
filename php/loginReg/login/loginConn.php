<?php

  if (isset($_POST['loginSub'])) {
    $emailUid = $_POST['emailUid'];
    $pwd = $_POST['pwd'];

    if(empty($emailUid) || empty($pwd)){
      header("Location: ../../../html/login.php?status=empty&emailUid=$emailUid");
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
      header("Location: ../../../html/login.php?status=error&emailUid=$emailUid");
      exit();
    } elseif (count($result) <= 0) {
      header("Location: ../../../html/login.php?status=nouser&emailUid=$emailUid");
      exit();
    } elseif (!password_verify($pwd, $result[0]['pwd'])){
      header("Location: ../../../html/login.php?status=wrongpwd&emailUid=$emailUid");
      exit();
    } else{
      header("Location: ../../../html/login.php?login=success");
      exit();
    }

  } else{
    header("Location: ../../../html/login.php");
    exit();
  }

 ?>
