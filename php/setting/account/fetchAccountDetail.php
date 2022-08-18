<?php

  if (isset($_SESSION['uid'])) {
    $uid = trim($_SESSION['uid']);
    require_once '../../php/dbConn.php';
    $pdo = pdoConn();
    $sql = "SELECT uid, email FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (count($row) <= 0 || count($row) > 1) {
      header("Location:../../index.php?status=error");
      exit();
    }
  } else{
    header("Location:../../index.php");
    exit();
  }

 ?>
