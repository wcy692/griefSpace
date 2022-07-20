<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  if (isset($_POST['regSub'])) {
    $uid = $_POST['uid'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $confirmPwd = $_POST['confirmPwd'];

    //input handler
    if(empty($uid) || empty($email) || empty($pwd) || empty($confirmPwd)){
      header("Location: ../../../html/login.php?status=empty&uid=$uid&email=$email");
      exit();
    } else if(preg_match('/\s/', $uid) || preg_match('/\s/', $pwd)){
      header("Location: ../../../html/login.php?status=whitespace&uid=$uid&email=$email");
      exit();
    } else if($confirmPwd != $pwd){
      header("Location: ../../../html/login.php?status=confirmpwd&uid=$uid&email=$email");
      exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../../../html/login.php?status=email&uid=$uid&email=$email");
      exit();
    } else if(strlen($pwd) < 8){
      header("Location: ../../../html/login.php?status=pwdlen&uid=$uid&email=$email");
      exit();
    } else if(!preg_match('/\d/', $pwd)){
      header("Location: ../../../html/login.php?status=pwdDigit&uid=$uid&email=$email");
      exit();
    } else if(!preg_match('/[A-Z]/', $pwd)){
      header("Location: ../../../html/login.php?status=pwdUpper&uid=$uid&email=$email");
      exit();
    } else if(!preg_match('/[a-z]/', $pwd)){
      header("Location: ../../../html/login.php?status=pwdLower&uid=$uid&email=$email");
      exit();
    } else if(!preg_match('/\W/', $pwd)){
      header("Location: ../../../html/login.php?status=pwdSpecial&uid=$uid&email=$email");
      exit();
    }

    require_once '../../dbConn.php';
    $pdo = pdoConn();

    $sql = 'SELECT * FROM userdata WHERE uid=? OR email=?;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->execute();
    $count = count($stmt->fetchAll());
    if ($count > 0) {
      header("Location: ../../../html/login.php?status=userexist&uid=$uid&email=$email");
      exit();
    }

    $sql = 'INSERT INTO userdata(uid, email, pwd) VALUES(?,?,?);';
    $stmt = $pdo->prepare($sql);
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $pwd, PDO::PARAM_STR);
    $stmt->execute();

    // select the id number to allow inserting into the activation table as foreign keys
    $sql = 'SELECT id FROM userdata WHERE uid=?;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $uid, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (count($result) > 1 || count($result) < 0) {
      header("Location: ../../../html/login.php?status=error&uid=$uid&email=$email");
      exit();
    } else{
      $idNum = (int)$result[0]['id'];
    }

    //generate token and expiry
    $hexToken = bin2hex(random_bytes(8));
    $hashtoken = password_hash($hexToken, PASSWORD_DEFAULT);
    $expiry = date('U') + 1800;

    //populate activation table
    $sql = 'INSERT INTO activation(userdata_id, token, expiry) VALUES(?,?,?);';
    $stmt = $pdo->prepare($sql);
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt->bindParam(1, $idNum, PDO::PARAM_INT);
    $stmt->bindParam(2, $hashtoken, PDO::PARAM_STR);
    $stmt->bindParam(3, $expiry, PDO::PARAM_STR);
    $stmt->execute();

    //send activation email
    require '../../email/sendEmail.php';
    require '../../emailTemplate/regEmail.php';
    $subject = getSubject();
    $body = getBody($hexToken);
    $successUrl = "Location: ../../../html/login.php?reg=success";
    $failUrl = "Location: ../../../html/login.php?status=sendErr&uid=$uid&email=$email";
    sendEmail($uid, $email, $subject, $body, $successUrl, $failUrl);
    exit();

  } else{
    header("Location: ../../../html/login.php");
    exit();
  }


 ?>
