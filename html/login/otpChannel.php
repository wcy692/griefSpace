<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Activate your account | griefSpace</title>
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/center.css">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/activation.css">
    <link rel="stylesheet" href="../../css/otpChannel.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body class="fontInter">
    <div class="textContainer">
      <h1 class="heading">griefSpace</h1>
    </div>
    <?php
        if (isset($_GET['status']) && $_GET['status'] != 'success') {
          echo '<div class="popup">
          <img class="closeBtn" src="../../pic/icon/closeBtn_black.svg" alt="close-popup">';
          $status = $_GET['status'];
          if ($status == 'number') {
            echo '<h2>Bad Request:</h2>
                  <h3>Oops...Seems like you entered a invalid number. Please re-enter your otp.</h3>';
          } elseif ($status == 'wrongpwd') {
            echo '<h2>Password Unmatched:</h2>
                  <h3>Incorrect OTP.</h3>';
          }
          echo '</div>';
        }
     ?>
    <div id="otpForm" class="formContainer flexColumn flex">
      <div class="wrapper loginWrapper">
        <form class="activationForm flex alignCenter flexColumn activeForm" action="../../php/loginReg/login/otpValidate.php" method="post">
          <h2 class="heading">Enter OTP</h2>
          <div class="inputContainer">
            <h3>Please check your email inbox and receive the one-time password: </h3>
            <div class="pwdContainer flex justifyCenter">
              <input type="text" name="num1" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
              <input type="text" name="num2" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
              <input type="text" name="num3" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
              <input type="text" name="num4" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
              <input type="text" name="num5" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
              <input type="text" name="num6" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
            </div>
          </div>
          <button class="actionBtn" type="submit" name="otpSub">Proceed</button>
          <a class="actionBtn secondBtn" href="../home.php">Back to homepage</a>
        </form>
      </div>
    </div>
  </body>
  <script src="../../js/popupConn.js"></script>
</html>
