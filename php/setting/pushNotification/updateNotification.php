<?php
  session_start();
  if (isset($_POST['param']) && $_SESSION['uid']) {
    $paramArr = json_decode($_POST['param']);
    $uid = strtolower(trim($_SESSION['uid']));

    $statusArr = array();
    require_once '../../dbConn.php';
    $pdo = pdoConn();
    $sql = "SELECT id FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (count($row) != 1) {
      $statusArr['update'] = 'error';
      echo json_encode($statusArr);
      exit();
    }
    $userdata_id = (int)$row[0]['id'];

    $sql = '';
    $true = 1;
    $false = 0;

    if (count($paramArr) < 0 || count($paramArr) > 2) {
      $statusArr['update'] = 'error';
      echo json_encode($statusArr);
      exit();
    } elseif (count($paramArr) == 0) {
      $sql .= 'UPDATE user_notification
                SET journal_created=?, journal_updated=?
                WHERE userdata_id=?;';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $false, PDO::PARAM_INT);
      $stmt->bindParam(2, $false, PDO::PARAM_INT);
      $stmt->bindParam(3, $userdata_id, PDO::PARAM_INT);

    } elseif (count($paramArr) == 1 && $paramArr[0] == 'journal created') {
      $sql .= 'UPDATE user_notification
                SET journal_created=?, journal_updated=?
                WHERE userdata_id=?;';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $true, PDO::PARAM_INT);
      $stmt->bindParam(2, $false, PDO::PARAM_INT);
      $stmt->bindParam(3, $userdata_id, PDO::PARAM_INT);
    } elseif (count($paramArr) == 1 && $paramArr[0] == 'journal updated') {
      $sql .= 'UPDATE user_notification
                SET journal_created=?, journal_updated=?
                WHERE userdata_id=?;';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $false, PDO::PARAM_INT);
      $stmt->bindParam(2, $true, PDO::PARAM_INT);
      $stmt->bindParam(3, $userdata_id, PDO::PARAM_INT);
    } elseif (count($paramArr) == 2) {
      $sql .= 'UPDATE user_notification
                SET journal_created=?, journal_updated=?
                WHERE userdata_id=?;';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $true, PDO::PARAM_INT);
      $stmt->bindParam(2, $true, PDO::PARAM_INT);
      $stmt->bindParam(3, $userdata_id, PDO::PARAM_INT);
    }
    if (!$stmt->execute()) {
      $statusArr['update'] = 'error';
    } else{
      $statusArr['update'] = 'success';
    }

    echo json_encode($statusArr);
    exit();

  } else{
    $statusArr['update'] = 'invalid';
    echo json_encode($statusArr);
    exit();
  }
 ?>
