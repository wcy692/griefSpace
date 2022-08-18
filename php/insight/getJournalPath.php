<?php

    session_start();

    if (isset($_POST['dateStr']) && isset($_SESSION['uid'])) {
      $format = 'Y-m-d';
      $dateStr = $_POST['dateStr'];
      $epoch = strtotime($dateStr);

      $date = new DateTime($dateStr);
      $start_epoch = (int)$date->format('U');
      $date->modify('+1 day');
      $end_epoch = (int)$date->format('U');


      $uid = $_SESSION['uid'];
      require_once '../dbConn.php';
      $pdo = pdoConn();
      $sql = "SELECT id FROM userdata WHERE uid=?;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $uid, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetchAll();
      $userdata_id = (int)trim($row[0]['id']);

      $sql = "SELECT DISTINCT journal_id, createTime FROM journal_basic WHERE userdata_id=?;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
      $stmt->execute();
      $row = $stmt->fetchAll();

      foreach ($row as $ele) {
        $db_epoch = (int)$ele['createTime'];
        if ($db_epoch >= $start_epoch && $db_epoch < $end_epoch) {
          echo $ele['journal_id'];
        }
      }
    }

 ?>
