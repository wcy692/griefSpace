<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome back | griefSpace</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/center.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/homeSwiper.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
  </head>
  <body class="fontInter">

    <section class="swiper mySwiper">
      <div class="swiper-wrapper">

    <section id="formSlide" class="swiper-slide">
      <div class="textContainer">
        <h1 class="heading">griefSpace</h1>
        <h2>A mourning space to store media, log journals and track emotions</h2>
      </div>
      <div class="formContainer flexColumn flex">
        <?php
          if (isset($_GET['status']) && $_GET['status'] != 'success') {
            echo '<div class="message">';
            $status = $_GET['status'];
            if ($status == 'empty') {
              echo '<h3>Missing fields:</h3>
                    <h5>Please enter all necessary fields.</h5>';
            } elseif ($status == 'whitespace') {
              echo '<h3>Whitespace not allowed:</h3>
                    <h5>Please do not include whitespace in your username and password.</h5>';
            } elseif ($status == 'email') {
              echo '<h3>Invalid email:</h3>
                    <h5>Please enter a valid email address.</h5>';
            } elseif ($status == 'confirmpwd') {
              echo '<h3>Repeat password:</h3>
                    <h5>Please enter the same password in both password field and confirm password field.</h5>';
            } elseif ($status == 'pwdlen' || $status == 'pwdSpecial' || $status == 'pwdUpper' || $status == 'pwdLower' || $status == 'pwdDigit') {
              echo '<h3>Password format:</h3>
                    <h5>Invalid password. Please check out below password guide: <br><br></h5>
                    <h5>1. have at least one UPPER case. <br>
                        2. have at least one lower case. <br>
                        3. have at least one digit.<br>
                        4. have NO whitspace.<br>
                        5. have at least one special character.<br>
                        6. be at least 8-character long.</h5>';
            } elseif ($status == 'wrongpwd') {
              echo '<h3>Password Unmatched:</h3>
                    <h5>Incorrect Password.</h5>';
            }  elseif ($status == 'nouser') {
              echo '<h3>User not found:</h3>
                    <h5>No record found for this user or email address.</h5>';
            }  elseif ($status == 'error') {
              echo '<h3>Server error:</h3>
                    <h5>Oops... something went wrong in the server. Please try again later.</h5>';
            }  elseif ($status == 'sendErr') {
              echo '<h3>Email error:</h3>
                    <h5>Oops... Activation email couldn\'t send out. Please contact out customer service.</h5>';
            }
            echo '</div>';
          } elseif(isset($_GET['reg']) && $_GET['reg'] == 'success'){
            echo '<div class="message green flex alignCenter flexColumn">
                    <img src="../pic/icon/tick.svg" alt="register-success">
                    <h1>Congrats:</h1>
                  <h3>You\'ve successfully registered. Please check your email inbox to finish the activation.</h3></div>';
            exit();
          } elseif(isset($_GET['login']) && $_GET['login'] == 'success'){
            echo '<div class="message green flex alignCenter flexColumn">
                    <img src="../pic/icon/tick.svg" alt="register-success">
                    <h1>Welcome back</h1></div>';
            exit();
          }
         ?>
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
      <div class="swipeReminder flex">
        <div class="emptyLeft"></div>
        <div class="swipeReminderConn flex">
          <h2>Swipe <span class="highlight">left</span> to see why griefSpace</h2>
          <img src="../pic/icon/arrow.svg" alt="">
        </div>
      </div>
    </section>

    <section id="slide_second" class="swiper-slide">
      <div class="textContainer">
        <h1 class="heading">griefSpace</h1>
        <h2 class="upperText">Supports <span class="highlight">multi-media</span> such as photos, videos and audios</h2>
        <h2>Keep your emotions and message <span class="highlight">away from exposure</span></h2>
        <div class="hero"><img src="../pic/home/sliderHero/handWithMedia.svg" alt="media-storage-space"></div>
      </div>
      <div class="swipeReminder flex">
        <div class="emptyLeft"></div>
        <div class="swipeReminderConn flex">
          <h2>Swipe <span class="highlight">left</span> to see why griefSpace</h2>
          <img src="../pic/icon/arrow.svg" alt="">
        </div>
      </div>
    </section>

    <section id="slide_third" class="swiper-slide">
      <div class="textContainer">
        <h1 class="heading">griefSpace</h1>
        <h2 class="upperText">A private space to write a journal to <span class="highlight">relieve your emotions securely </span> </h2>
        <div class="hero"><img src="../pic/home/sliderHero/handWithMedia.svg" alt="media-storage-space"></div>
      </div>
      <div class="swipeReminder flex">
        <div class="emptyLeft"></div>
        <div class="swipeReminderConn flex">
          <h2>Swipe <span class="highlight">left</span> to see why griefSpace</h2>
          <img src="../pic/icon/arrow.svg" alt="">
        </div>
      </div>
    </section>

    <section id="slide_forth" class="swiper-slide">
      <div class="textContainer">
        <h1 class="heading">griefSpace</h1>
        <h2 class="upperText"><span class="highlight">Visualise</span> your changes in emotions</h2>
        <h2>Keep eyes on the <span class="highlight">changes</span> in emotions</h2>
        <div class="hero flex justifyCenter alignCenter"><img src="../pic/home/sliderHero/pie.svg" alt="media-storage-space"></div>
      </div>
      <div class="swipeReminder flex">
        <div class="emptyLeft"></div>
        <div class="swipeReminderConn flex">
          <h2>Swipe <span class="highlight">left</span> to see why griefSpace</h2>
          <img src="../pic/icon/arrow.svg" alt="">
        </div>
      </div>
    </section>

  <!-- close swiper-wrapper -->
  </div>
  </section>

  <div class="swiper-pagination"></div>

  </body>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        pagination: {
          el: ".swiper-pagination",
        },
      });
  </script>
  <script src="../js/login/changeFormConn.js"></script>
  <script src="../js/login/showPwd.js"></script>
</html>
