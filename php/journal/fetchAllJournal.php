<?php

  session_start();
  if (!isset($_SESSION['uid'])) {
    echo "fail:login";
    exit();
  } else{
    $session_uid = $_SESSION['uid'];
  }

  require_once '../dbConn.php';
  $pdo = pdoConn();
  $sql = "SELECT journal_basic.title, journal_basic.updateTime, journal_basic.journal_id FROM journal_basic
            JOIN userdata ON journal_basic.userdata_id=userdata.id
            AND userdata.uid=?
            GROUP BY journal_basic.journal_id
            ORDER BY journal_basic.updateTime DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $session_uid, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetchAll();

  $titleArr = array();
  $timeArr = array();
  $journalIdArr = array();

  foreach ($row as $ele) {
    $titleArr[] = $ele['title'];
    $timeArr[] = date("Y-m-d (H:i)", (int)$ele['updateTime']);
    $journalIdArr[] = $ele['journal_id'];
  }
  $res = array();
  $res[] = $titleArr;
  $res[] = $timeArr;
  $res[] = $journalIdArr;

  echo json_encode($res);
 ?>
