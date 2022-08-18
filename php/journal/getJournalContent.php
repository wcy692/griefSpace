<?php

  session_start();
  if (isset($_POST['param']) && isset($_SESSION['uid'])) {
    $param = $_POST['param'];
    $paramArr = explode(";", $param);
    $journal_id = (int) explode("=", $paramArr[0])[1];
    $question_id = (int) explode("=", $paramArr[1])[1];

    // conditional statement for question sql
    $question_sql = $question_id > 0 ? ' AND journal_basic.question_id=?;' : ';';

    $session_uid = $_SESSION['uid'];
    require_once '../dbConn.php';
    $pdo = pdoConn();
    $sql = "SELECT journal_basic.title, journal_basic.emotion_id, journal_basic.question_id, journal_basic.ans
              FROM journal_basic
              JOIN userdata ON journal_basic.userdata_id=userdata.id
              AND userdata.uid=? AND journal_basic.journal_id=?";

    $sql .= $question_sql;

    $stmt = $pdo->prepare($sql);

    if ($question_id > 0) {
      $stmt->bindParam(1, $session_uid, PDO::PARAM_STR);
      $stmt->bindParam(2, $journal_id, PDO::PARAM_INT);
      $stmt->bindParam(3, $question_id, PDO::PARAM_INT);
      $stmt->execute();
    } else{
      $stmt->bindParam(1, $session_uid, PDO::PARAM_STR);
      $stmt->bindParam(2, $journal_id, PDO::PARAM_INT);
      $stmt->execute();
    }
    $row = $stmt->fetchAll();

    $questionIdArr = array();
    $ansArr = array();
    $emotionId = -1;
    $title = '';
    foreach ($row as $key) {
      $questionIdArr[] = (int)$key['question_id'];
      $ansArr[] = $key['ans'];
      $emotionId = (int)$key['emotion_id'];
      $title = $key['title'];
    }

    $questionArr = array();
    foreach ($questionIdArr as $id) {
      $sql = "SELECT context FROM journal_question WHERE id=?;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $id, PDO::PARAM_INT);
      $stmt->execute();
      $questionRes = $stmt->fetchAll();
      foreach ($questionRes as $key) {
        $questionArr[] = $key['context'];
      }
    }

    $sql = "SELECT context FROM emotion WHERE id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $emotionId, PDO::PARAM_INT);
    $stmt->execute();
    $emotionRes = $stmt->fetchAll();
    $emotion = $emotionRes[0]['context'];

    $returnData = array();
    $returnData[] = $title;
    $returnData[] = $emotion;
    $returnData[] = $questionArr;
    $returnData[] = $ansArr;
    $returnData[] = $questionIdArr;

    echo json_encode($returnData);
  } else{
    echo 'invalid';
  }

 ?>
