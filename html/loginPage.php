<?php

  session_start();
  if (isset($_SESSION['uid'])) {
    header("Location:./home.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome back | griefSpace</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/center.css">
    <link rel="stylesheet" href="../css/topNav.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/homeSwiper.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
  </head>
  <body class="fontInter">

    <?php
      if (isset($_GET['status']) && $_GET['status'] != 'success') {
        echo '<div class="popup">
        <img class="closeBtn" src="../pic/icon/closeBtn_black.svg" alt="close-popup">';
        $status = $_GET['status'];
        if ($status == 'empty') {
          echo '<h2>Missing fields:</h2>
                <h3>Please enter all necessary fields.</h3>';
        } elseif ($status == 'whitespace') {
          echo '<h2>Whitespace not allowed:</h2>
                <h3>Please do not include whitespace in your username and password.</h3>';
        } elseif ($status == 'userexist') {
          echo '<h2>User existed:</h2>
                <h3>This username or email address have already been used.</h3>';
        } elseif ($status == 'email') {
          echo '<h2>Invalid email:</h2>
                <h3>Please enter a valid email address.</h3>';
        } elseif ($status == 'confirmpwd') {
          echo '<h2>Repeat password:</h2>
                <h3>Please enter the same password in both password field and confirm password field.</h3>';
        } elseif ($status == 'pwdlen' || $status == 'pwdSpecial' || $status == 'pwdUpper' || $status == 'pwdLower' || $status == 'pwdDigit') {
          echo '<h2>Password format:</h2>
                <h3>Invalid password. Please check out below password guide: <br><br></h3>
                <h3>1. have at least one UPPER case. <br>
                    2. have at least one lower case. <br>
                    3. have at least one digit.<br>
                    4. have NO whitspace.<br>
                    5. have at least one special character.<br>
                    6. be at least 8-character long.</h3>';
        } elseif ($status == 'wrongpwd') {
          echo '<h2>Password Unmatched:</h2>
                <h3>Incorrect Password.</h3>';
        }  elseif ($status == 'nouser') {
          echo '<h2>User not found:</h2>
                <h3>No record found for this user or email address.</h3>';
        }  elseif ($status == 'error') {
          echo '<h2>Server error:</h2>
                <h3>Oops... something went wrong in the server. Please try again later.</h3>';
        }  elseif ($status == 'sendErr') {
          echo '<h2>Email error:</h2>
                <h3>Oops... Activation email couldn\'t send out. Please contact out customer service.</h3>';
        }
        echo '</div>';
      } elseif(isset($_GET['reg']) && $_GET['reg'] == 'success'){
        echo '<div class="message green flex alignCenter flexColumn">
                <img src="../pic/icon/tick.svg" alt="register-success">
                <h1>Congrats:</h1>
                <h3>You\'ve successfully registered. Please check your email inbox to finish the activation.</h3>
                <a class="actionBtn" href="./loginPage.php">Back to Login</a></div>';
        exit();
      } elseif(isset($_GET['login']) && $_GET['login'] == 'success'){
        echo '<div class="message green flex alignCenter flexColumn">
                <img src="../pic/icon/tick.svg" alt="register-success">
                <h1>Hello,</h1>
                <h3>Welcome back.</h3>
                <a class="actionBtn" href="./home.php">Continue</a></div>';
        exit();
      }
     ?>

     <section class="topNav flex alignCenter justifyCenter">
       <nav class="flex justifyBetween alignCenter">
         <h2 class="logo">griefSpace</h2>
         <div class="linkContainer flex">
           <h5><a href="../index.php">Home</a></h5>
           <h5 class="toggleFeature">Features</h5>
         </div>
         <div class="btnContainer">
           <?php
             if (!isset($_SESSION['uid'])) {
               echo '<button class="actionBtn" type="button"><h5><a href="./loginPage.php">Login</a></h5></button>';
             } else{
               echo '<form action="../php/loginReg/login/logout.php" method="post">
                      <button class="actionBtn secondBtn logoutBtn" type="submit" name="logoutBtn"><h5>Logout</h5></button>
                     </form>';
             }
            ?>
         </div>
       </nav>
     </section>

     <nav class="hiddenFeature">
       <div class="linkContainer flex flexColumn alignCenter">
         <h5><a href="./journal/journal.php">Journal</a></h5>
         <h5><a href="./insight/insight.php">Insight</a></h5>
         <h5><a href="./setting/setting.php">Settings</a></h5>
       </div>
     </nav>

     <div class="content">
       <div class="formContainer flexColumn flex">
          <div class="wrapper loginWrapper">
            <form class="loginForm flex alignCenter flexColumn activeForm" action="../php/loginReg/login/loginConn.php" method="post">
              <h2 class="heading">Login Now</h2>
              <div class="inputContainer">
                <label for="emailUidInput">Email or username: </label>
                <?php
                 if (isset($_GET['emailUid'])) {
                   echo '<input id="emailUidInput" type="text" name="emailUid" placeholder="example@gmail.com" value="'.$_GET['emailUid'].'">';
                 } else{
                   echo '<input id="emailUidInput" type="text" name="emailUid" placeholder="example@gmail.com" value="">';
                 }
                 ?>
               </div>
               <div class="inputContainer">
                 <label for="loginPwdInput">Password: </label>
                 <div class="pwdContainer flex">
                   <input type="password" name="pwd" placeholder="!Aa12345678" value="">
                   <button class="showPwdBtn" type="button">Show</button>
                 </div>
               </div>
             <button class="actionBtn" type="submit" name="loginSub">Login</button>
             <div class="linkContainer">
               <a href="./resend/getResetPwdLetter.php" class="formLink">Forget password?</a>
               <p class="formLink toggleFormBtn">Don’t have an account? <span class="highlight">Register</span> now</p>
             </div>
           </form>
           <form class="regForm flex alignCenter flexColumn" action="../php/loginReg/register/regConn.php" method="post">
             <h2 class="heading">Register</h2>
             <div class="inputContainer">
               <label for="uidInput">Username: </label>
               <?php
                   if (isset($_GET['uid'])) {
                     echo '<input id="uidInput" type="text" name="uid" placeholder="example123" value="'.$_GET['uid'].'">';
                   } else{
                     echo '<input id="uidInput" type="text" name="uid" placeholder="example123" value="">';
                   }
                   ?>
                 </div>
                 <div class="inputContainer">
                     <label for="emailInput">Email address: </label>
                     <?php
                     if (isset($_GET['email'])) {
                       echo '<input id="emailInput" type="text" name="email" placeholder="example@gmail.com" value="'.$_GET['email'].'">';
                     } else{
                       echo '<input id="emailInput" type="text" name="email" placeholder="example@gmail.com" value="">';
                     }
                     ?>
                 </div>
                 <div class="inputContainer">
                   <label for="regPwdInput">Password: </label>
                   <div class="pwdContainer flex">
                     <input id="regPwdInput" type="password" name="pwd" placeholder="Password" value="">
                     <button class="showPwdBtn" type="button">Show</button>
                   </div>
                 </div>
                 <div class="inputContainer">
                   <label for="regConfirmPwd">Confirm Password: </label>
                   <div class="pwdContainer flex">
                     <input id="regConfirmPwd" type="password" name="confirmPwd" placeholder="Confirm Password" value="">
                     <button class="showPwdBtn" type="button">Show</button>
                   </div>
                 </div>
                 <button class="actionBtn" type="submit" name="regSub">Register</button>
                 <div class="linkContainer"><p class="formLink toggleFormBtn">Already got an account? <span class="highlight">Login</span> now</p></div>
               </form>
         </div>
       </div>
     </div>
  </body>
  <script src="../js/login/changeFormConn.js"></script>
  <script src="../js/login/showPwd.js"></script>
  <script src="../js/popupConn.js"></script>
  <script src="../js/toggleFeature.js"></script>
</html>
