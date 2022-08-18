<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset password | griefSpace</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/center.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/activation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body class="fontInter">
    <div class="textContainer">
      <h1 class="heading">griefSpace</h1>
    </div>
    <?php

      if (!isset($_GET['token'])) {
        if (isset($_GET['status'])) {
          $status = $_GET['status'];
          if ($status == 'token') {
            echo '<div class="message orangeBg flex alignCenter flexColumn">
                    <img src="../pic/icon/cross.svg" alt="reject-attempt">
                    <h1>Missing token:</h1>
                    <h3>You got an incorrect token. Please click the below button to request a new letter.</h3>
                    <a class="actionBtn" href="./resend/getResetPwdLetter.php">Request</a></div>';
            exit();
          } elseif ($status == 'expiry') {
            echo '<div class="message orangeBg flex alignCenter flexColumn">
                    <img src="../pic/icon/cross.svg" alt="reject-attempt">
                    <h1>Expired request:</h1>
                    <h3>Oops...Looks like your request is expired.<br> Please click the below button to request a new letter.</h3>
                    <a class="actionBtn" href="./resend/getResetPwdLetter.php">Request</a></div>';
            exit();
          }

        } elseif (isset($_GET['reset'])) {
          $reset = $_GET['reset'];
          if($_GET['reset'] == 'success'){
            echo '<div class="message green flex alignCenter flexColumn">
                    <img src="../pic/icon/tick.svg" alt="register-success">
                    <h1>Congrats:</h1>
                    <h3>You\'ve just reset your password.<br> From now on, you will have to log on your space using the new password.</h3>
                    <a class="actionBtn" href="./loginPage.php">Login</a></div>';
            exit();
          } elseif($_GET['reset'] == 'sendErr'){
            echo '<div class="message orangeBg flex alignCenter flexColumn">
                    <img src="../pic/icon/questionMark.svg" alt="good-attempt-with-error">
                    <h1>Confirmation email error:</h1>
                    <h3>Oops... Something went wrong when we are sending out the confirmation letter. But no worries, you still successfully reset your password.</h3>
                    <a class="actionBtn" href="./loginPage.php">Login</a></div>';
            exit();
          }
        } else{
          echo '<div class="message orangeBg flex alignCenter flexColumn">
                  <img src="../pic/icon/cross.svg" alt="reject-attempt">
                  <h1>Missing token:</h1>
                  <h3>You got an incorrect token. Please click the below button to request a new letter.</h3>
                  <a class="actionBtn" href="./resend/getResetPwdLetter.php">Request</a></div>';
          exit();
        }

      } else{
        echo '<input type="hidden" name="token" value="'.$_GET['token'].'">';
        if (isset($_GET['status'])) {
          $status = $_GET['status'];
          if ($status != "success" && $status != "token" && $status != "expiry") {
            echo '<div class="popup"><img class="closeBtn" src="../pic/icon/closeBtn_black.svg" alt="close-popup">';
            if ($status == 'empty') {
              echo '<h2>Missing fields:</h2>
                    <h3>Please enter all necessary fields.</h3>';
            } elseif ($status == 'nouser') {
              echo '<h2>User not found:</h2>
                    <h3>This username hasn\'t been registered.</h3>';
            } elseif ($status == 'norequest') {
              echo '<h2>No request:</h2>
                    <h3>No request for this username.</h3>';
            } elseif ($status == 'error') {
              echo '<h2>Server error:</h2>
                    <h3>Oops... something went wrong in the server. Please try again later.</h3>';
            } elseif ($status == 'pwdlen' || $status == 'pwdSpecial' || $status == 'pwdUpper' || $status == 'pwdLower' || $status == 'pwdDigit' || $status == 'whitespace') {
              echo '<h2>Password format:</h2>
                    <h3>Invalid password. Please check out below password guide: <br><br></h3>
                    <h3>1. have at least one UPPER case. <br>
                        2. have at least one lower case. <br>
                        3. have at least one digit.<br>
                        4. have NO whitspace.<br>
                        5. have at least one special character.<br>
                        6. be at least 8-character long.</h3>';
            }
            echo '</div>';
          }
        }
      }
     ?>
    <div class="formContainer flexColumn flex">
      <div class="wrapper loginWrapper">
        <form class="activationForm flex alignCenter flexColumn activeForm" action="../php/loginReg/login/resetPwd.php" method="post">
          <h2 class="heading">Reset Password</h2>
          <div class="inputContainer">
            <label for="uidInput">Username: </label>
            <?php
            if (isset($_GET['uid'])) {
              echo '<input id="uidInput" type="text" name="uid" placeholder="Username" value="'.$_GET['uid'].'">';
            } else{
              echo '<input id="uidInput" type="text" name="uid" placeholder="Username" value="">';
            }
            ?>
          </div>
          <div class="inputContainer">
            <label for="pwdInput">Password: </label>
            <div class="pwdContainer flex">
              <input id="pwdInput" type="password" name="pwd" placeholder="!Aa12345678" value="">
              <button class="showPwdBtn" type="button">Show</button>
            </div>
          </div>
          <div class="inputContainer">
            <label for="confirmPwd">Confirm Password: </label>
            <div class="pwdContainer flex">
              <input id="confirmPwd" type="password" name="confirmPwd" placeholder="!Aa12345678" value="">
              <button class="showPwdBtn" type="button">Show</button>
            </div>
          </div>
          <button class="actionBtn" type="submit" name="resetSub">Reset</button>
          <a class="actionBtn secondBtn" href="./loginPage.php">Back to login</a>
        </form>
      </div>
    </div>
  </body>
  <script src="../js/login/showPwd.js"></script>
  <script src="../js/popupConn.js"></script>
</html>
