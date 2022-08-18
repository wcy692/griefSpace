<?php

  session_start();

  if (!isset($_SESSION['uid'])) {
    header("Location:../../html/loginPage.php");
    exit();
  } else{
    $uid = trim($_SESSION['uid']);
  }

  require_once '../../php/dbConn.php';
  $pdo = pdoConn();

  $sql = "SELECT id FROM userdata WHERE uid=?;";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $uid, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetchAll();
  $userdata_id = (int)trim($row[0]['id']);

  $sql = "SELECT DISTINCT emotion_id, createTime FROM journal_basic WHERE userdata_id=?;";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $userdata_id, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetchAll();

  $timeArr = array();
  $emotionArr = array();

  foreach ($row as $ele) {
    // push into timeArr
    $timeArr[] =  trim($ele['createTime']);

    //get emotion names using its id
    $emotion_id = (int)$ele['emotion_id'];
    $sql = "SELECT context FROM emotion WHERE id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1,$emotion_id , PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $emotionArr[] = $row[0]['context'];
  }

  $search = ['terrible', 'bad', 'neutral', 'good', 'amazed'];
  $replace = ['#B26B45', '#256FFF', '#ffd24c', '#FBFF42', '#FD6C2E'];
  $colours = str_replace($search, $replace, $emotionArr);

  $format = 'U';
  $timezone = new DateTimeZone('Europe/London');
  $dateArr = array();

  foreach ($timeArr as $ele) {
    $dateTime = DateTime::createFromFormat($format, $ele);
    $dateTime->setTimezone($timezone);
    $dateArr[] = $dateTime->format('Y-m-d');
  }

 ?>
