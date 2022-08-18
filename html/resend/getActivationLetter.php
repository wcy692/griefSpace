<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Request Activation email | griefSpace</title>
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/center.css">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/activation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body class="fontInter">
    <div class="textContainer">
      <h1 class="heading">griefSpace</h1>
    </div>
    <?php
      if (!empty($_GET['status'])) {
        $status = $_GET['status'];
        if ($status != "success") {
          echo '<div class="popup"><img class="closeBtn" src="../../pic/icon/closeBtn_black.svg" alt="close-popup">';
          if ($status == 'empty') {
            echo '<h2>Missing fields:</h2>
                  <h3>Please enter all necessary fields.</h3>';
          } elseif ($status == 'email') {
            echo '<h2>Invalid email:</h2>
                  <h3>Please enter a valid email address.</h3>';
          } elseif ($status == 'nouser') {
            echo '<h2>User not found:</h2>
                  <h3>This email address hasn\'t been registered.</h3>';
          } elseif ($status == 'norequest') {
            echo '<h2>No request:</h2>
                  <h3>No activation request for this username.</h3>';
          } elseif ($status == 'error') {
            echo '<h2>Server error:</h2>
                  <h3>Oops... something went wrong in the server. Please try again later.</h3>';
          } elseif ($status == 'timelimit') {
            echo '<h2>Time limit:</h2>
                  <h3>You can only request a new activation letter every 30 minutes.</h3>';
          } elseif ($status == 'sendErr') {
            echo '<h2>Email error:</h2>
                  <h3>Oops... Activation email couldn\'t send out. Please contact out customer service.</h3>';
          }
          echo '</div>';
        }
      }  elseif(isset($_GET['request']) && $_GET['request'] == 'success'){
        echo '<div class="message green flex alignCenter flexColumn">
                <img src="../../pic/icon/tick.svg" alt="register-success">
                <h3>We\'ve sent another activation email to your email inbox. Please check your email inbox to proceed the activation procedure.</h3>
                <a class="actionBtn" href="../loginPage.php">Login</a></div>';
        exit();
      }
     ?>
    <div class="formContainer flexColumn flex">
      <div class="wrapper loginWrapper">
        <form class="activationForm flex alignCenter flexColumn activeForm" action="../../php/loginReg/register/requestActConn.php" method="post">
          <h2 class="heading">Request email</h2>
          <div class="inputContainer">
            <label for="emailInput">Email: </label>
            <?php
            if (isset($_GET['email'])) {
              echo '<input id="emailInput" type="text" name="email" placeholder="example@gmail.com" value="'.$_GET['email'].'">';
            } else{
              echo '<input id="emailInput" type="text" name="email" placeholder="example@gmail.com" value="">';
            }
            ?>
          </div>
          <button class="actionBtn" type="submit" name="requestSub">Request</button>
          <a class="actionBtn secondBtn" href="../loginPage.php">Back to login</a>
        </form>
      </div>
    </div>
  </body>
  <script src="../../js/popupConn.js"></script>
</html>
