<?php

  session_start();
  if (isset($_POST['param']) && isset($_SESSION['uid'])) {
    $param = $_POST['param'];
    $session_uid = trim($_SESSION['uid']);

    $paramArr = json_decode($param);

    $journal_id = (int)$paramArr[0];
    $title = strtolower(trim($paramArr[1]));
    $emotion = strtolower(trim($paramArr[2]));
    $questionArr = json_decode($paramArr[3]);
    $ansArr = json_decode($paramArr[4]);

    $statusArr = array();
    if (empty($journal_id)) {
      $statusArr['error'] = 'invalid';
    } elseif (empty($title)) {
      $statusArr['title'] = 'empty';
    } elseif (empty($emotion)) {
      $statusArr['emotion'] = 'empty';
    } elseif (empty($questionArr) || empty($ansArr)) {
      $statusArr['error'] = 'error';
    }

    foreach ($questionArr as $question) {
      if (strlen($question) <= 0 || strlen(trim($question)) <= 0) {
        $statusArr['error'] = 'error';
      }
    }

    $emptyAnsId = array();
    for ($i=0; $i < count($ansArr); $i++) {
      if (strlen(trim($ansArr[$i])) <= 0) {
        $emptyAnsId[] = $i;
      }
    }

    if (count($emptyAnsId) > 0) {
      $statusArr['ans'] = $emptyAnsId;
    }

    // exit before any sql manipulations
    if (count($statusArr) > 0) {
      echo json_encode($statusArr);
      exit();
    }

    require_once '../dbConn.php';
    $pdo = pdoConn();

    $sql = "SELECT id, email FROM userdata WHERE uid=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $session_uid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $userdata_id = (int)$row[0]['id'];
    $email = $row[0]['email'];

    $sql = "SELECT id FROM emotion WHERE context=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $emotion, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $emotion_id = (int)$row[0]['id'];

    $newIdArr = array();
    foreach ($questionArr as $question) {
      $tempStr = strtolower(trim($question));
      $sql = "SELECT id FROM journal_question WHERE context = ?;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $tempStr, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetchAll();
      $newIdArr[] = (int)$row[0]['id'];
    }

    $createTime = '';
    $sql = "SELECT createTime FROM journal_basic WHERE userdata_id=? AND journal_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $journal_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $createTime = $row[0]['createTime'];

    // get journal_created setting, true = send email after inserting journal
    $sql = "SELECT journal_updated FROM user_notification WHERE userdata_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $journal_updated = $row[0]['journal_updated'];

    $sql = "DELETE  FROM journal_basic WHERE userdata_id=? AND journal_id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $journal_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $isGoodRequest = 'true';
    $date = date("U");
    for($index=0; $index < count($newIdArr); $index++){
      $sql = "INSERT INTO journal_basic(userdata_id, journal_id, title, emotion_id, question_id, ans, createTime, updateTime) VALUES(?,?,?,?,?,?,?,?);";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
      $stmt->bindParam(2, $journal_id, PDO::PARAM_INT);
      $stmt->bindParam(3, $title, PDO::PARAM_STR);
      $stmt->bindParam(4, $emotion_id, PDO::PARAM_INT);
      $stmt->bindParam(5, $newIdArr[$index], PDO::PARAM_INT);
      $stmt->bindParam(6, $ansArr[$index], PDO::PARAM_STR);
      $stmt->bindParam(7, $createTime, PDO::PARAM_INT);
      $stmt->bindParam(8, $date, PDO::PARAM_INT);
      if (!$stmt->execute()) {
        $statusArr['error'] = 'error';
      } else{
        $sendRes = '';
        if ($journal_updated == 1) {
          // success and send email based on $journal_updated
          require_once '../email/sendEmail.php';
          require_once '../emailTemplate/journalUpdatedEmail.php';
          $subject = getSubject();
          $body = getBody();
          $sendRes = sendEmail($session_uid, $email, $subject, $body, null, null);
          $statusArr['send'] = $sendRes ? 'success' : 'failed';
        } else{
          $statusArr['success'] = 'true';
        }
      }
    }

    echo json_encode($statusArr);
    exit();

  } else{
    header("Location:../../html/journal/journal.php");
    exit();
  }

 ?>
