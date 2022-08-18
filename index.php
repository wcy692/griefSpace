<?php

  session_start();
  if (isset($_SESSION['uid'])) {
    header("Location:./html/home.php");
    exit();
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome back | griefSpace</title>
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/center.css">
    <link rel="stylesheet" href="./css/topNav.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/homeSwiper.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
  </head>
  <body class="fontInter">

    <?php
      if (isset($_GET['status']) && $_GET['status'] != 'success') {
        echo '<div class="popup">
        <img class="closeBtn" src="./pic/icon/closeBtn_black.svg" alt="close-popup">';
        $status = $_GET['status'];
        if ($status == 'error') {
          echo '<h2>Server error:</h2>
                <h3>Oops... something went wrong in the server. Please try again later.</h3>';
        } elseif ($status == 'sendErr') {
          echo '<h2>Email error:</h2>
                <h3>Oops... Activation email couldn\'t send out. Please contact out customer service.</h3>';
        }
        echo '</div>';
      } elseif (isset($_GET['setting']) && $_GET['setting'] == 'error') {
        echo '<div class="popup badRequest">
        <svg class="closeBtn" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="20" cy="20" r="18.5" stroke="#e7e7e7" stroke-width="3"/>
        <line y1="-1" x2="14.1421" y2="-1" transform="matrix(0.707107 0.707107 -0.906804 0.421552 14 16)" stroke="#e7e7e7" stroke-width="2"/>
        <line y1="-1" x2="14.1421" y2="-1" transform="matrix(0.707107 -0.707107 -0.906804 -0.421552 14 25)" stroke="#e7e7e7" stroke-width="2"/>
        </svg>';
        echo '<h2>Bad Request:</h2>
              <h3>Something went wrong when processing your setting. Please try again later.</h3></div>';
      }
     ?>
     <section class="topNav flex alignCenter justifyCenter">
       <nav class="flex justifyBetween alignCenter">
         <h2 class="logo">griefSpace</h2>
         <div class="linkContainer flex">
           <h5><a href="./index.php">Home</a></h5>
           <h5 class="toggleFeature">Features</h5>
         </div>
         <div class="btnContainer">
           <?php
             if (!isset($_SESSION['uid'])) {
               echo '<button class="actionBtn" type="button"><h5><a href="./html/loginPage.php">Login</a></h5></button>';
             } else{
               echo '<form action="./php/loginReg/login/logout.php" method="post">
                      <button class="actionBtn secondBtn logoutBtn" type="submit" name="logoutBtn"><h5>Logout</h5></button>
                     </form>';
             }
            ?>
         </div>
       </nav>
     </section>

     <nav class="hiddenFeature">
       <div class="linkContainer flex flexColumn alignCenter">
         <h5><a href="./html/journal/journal.php">Journal</a></h5>
         <h5><a href="./html/insight/insight.php">Insight</a></h5>
         <h5><a href="./html/setting/setting.php">Settings</a></h5>
       </div>
     </nav>

     <div class="content">
           <section class="swiper mySwiper">
             <div class="swiper-wrapper">
                 <section id="slide_one" class="swiper-slide">
                   <div class="textContainer">
                     <div class="heroText flex flexColumn justifyCenter alignCenter">
                       <h4 class="heading">Welcome to griefSpace</h4>
                       <h2 class="upperText">A space to grief <span class="highlight">privately</span><br>
                       Swipe left to learn more</span></h2>
                     </div>
                   </div>
                 </section>

                 <section id="slide_second" class="swiper-slide">
                   <div class="textContainer">
                     <h1 class="heading">griefSpace</h1>
                     <h2 class="upperText">A private space to write a journal to <span class="highlight">relieve your emotions securely </span> </h2>
                     <div class="hero flex justifyCenter alignCenter"><img src="./pic/home/sliderHero/journal.svg" alt="jouranlling system"></div>
                   </div>
                   <div class="swipeReminder flex">
                     <div class="emptyLeft"></div>
                     <div class="swipeReminderConn flex">
                       <h2>Swipe <span class="highlight">left</span> to see why griefSpace</h2>
                       <img src="./pic/icon/arrow.svg" alt="">
                     </div>
                   </div>
                 </section>

                 <section id="slide_third" class="swiper-slide">
                   <div class="textContainer">
                     <h1 class="heading">griefSpace</h1>
                     <h2 class="upperText"><span class="highlight">Visualise</span> your changes in emotions</h2>
                     <h2>Keep eyes on the <span class="highlight">changes</span> in emotions</h2>
                     <div class="hero flex justifyCenter alignCenter"><img src="./pic/home/sliderHero/calendar.svg" alt="media-storage-space"></div>
                   </div>
                   <div class="swipeReminder flex">
                     <div class="emptyLeft"></div>
                     <div class="swipeReminderConn flex">
                       <h2>Swipe <span class="highlight">left</span> to see why griefSpace</h2>
                       <img src="./pic/icon/arrow.svg" alt="">
                     </div>
                   </div>
                 </section>

                 <section id="slide_forth" class="swiper-slide">
                   <div class="textContainer">
                     <div class="heroText flex flexColumn justifyCenter alignCenter">
                       <h4 class="heading">Ready to login?</h4>
                       <button class="actionBtn upperText" type="button"><h5><a href="./html/loginPage.php">Click to login</a></h5></button>
                     </div>
                   </div>
                 </section>

                 <!-- close swiper-wrapper -->
               </div>
         </section>

         <div class="swiper-pagination"></div>

         <section class="bigHome">
           <div id="loginIntro" class="wrapper flex alignCenter justifyCenter">
             <div class="container flex alignCenter justifyCenter">
               <div class="left">
                 <div class="desc flex flexColumn alignCenter">
                   <h5>A digital mourning space to store media, log journals and track emotions</h5>
                   <?php
                     if (!isset($_SESSION['uid'])) {
                       echo '<div class="btnContainer">
                               <button class="actionBtn" type="button"><h5><a href="./html/loginPage.php">Login</a></h5></button>
                             </div>';
                     }
                    ?>
                 </div>
               </div>
               <div class="right">
                 <h1><span class="purple">griefSpace</span></h1>
               </div>
             </div>
           </div>

           <div class="wrapper flex flexColumn alignCenter justifyCenter">
             <h5 class="heading">Why griefSpace</h5>
             <div class="container flex alignCenter justifyCenter">
               <div class="left">
                 <div class="desc flex flexColumn">
                   <h1>Jornalling <span class="purple">Story-telling</span> approach</h1>
                   <h5 class="upper">A <span class="orange">private</span> place to write a journal to relieve your emotions securely</h5>
                 </div>
               </div>
               <div class="right flex justifyCenter">
                 <img id="journal-hero" src="./pic/home/sliderHero/journal.svg" alt="jouranlling system">
               </div>
             </div>
           </div>

           <div class="wrapper flex flexColumn alignCenter justifyCenter">
             <h5 class="heading">Why griefSpace</h5>
             <div class="container flex alignCenter justifyCenter">
               <div class="left">
                 <div class="desc flex flexColumn">
                   <h1><span class="purple">Visualising</span> emotion</h1>
                   <h5 class="upper">View your emotion <span class="orange">trends</span> in a support of <span class="orange">calendar</span></h5>
                   <h5>Keep tracking your emotions with one click</h5>
                 </div>
               </div>
               <div class="right flex justifyCenter">
                 <img id="calendar-hero" src="./pic/home/sliderHero/calendar.svg" alt="">
               </div>
             </div>
           </div>

         </section>
     </div>

  </body>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
      var swiper = new Swiper(".mySwiper", {
        pagination: {
          el: ".swiper-pagination",
        },
      });
  </script>
  <script src="./js/popupConn.js"></script>
  <script src="./js/toggleFeature.js"></script>
</html>
