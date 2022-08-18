<?php
  session_start();
  if (isset($_POST['param']) && isset($_SESSION['uid'])) {
    $statusArr = array();
    if (strtolower(trim($_POST['param'])) != 'fetchloginsetting') {
      $statusArr['fetch'] = 'invalid';
      echo json_encode($statusArr);
      exit();
    }
    $uid = trim($_SESSION['uid']);
    require_once '../../dbConn.php';
    $pdo = pdoConn();

    $sql = "SELECT id FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if (count($row) != 1) {
      $statusArr['fetch'] = 'error';
      echo json_encode($statusArr);
      exit();
    }
    $userdata_id = (int)$row[0]['id'];

    $sql = "SELECT login_alert, one_time_pwd FROM user_notification WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();

    if (count($row) != 1) {
      $statusArr['fetch'] = 'error';
      echo json_encode($statusArr);
      exit();
    }

    $settingArr = array();
    $settingArr['login_alert'] = $row[0]['login_alert'];
    $settingArr['one_time_pwd'] = $row[0]['one_time_pwd'];

    echo json_encode($settingArr);

  } else{
    $statusArr['fetch'] = 'invalid';
    echo json_encode($statusArr);
    exit();
  }
 ?>
