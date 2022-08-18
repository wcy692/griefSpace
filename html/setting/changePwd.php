<?php

  session_start();
  if (!isset($_SESSION['uid'])) {
    header("Location:../loginPage.php");
    exit();
  }

  require_once '../../php/setting/account/fetchAccountDetail.php';

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Setting | greifSpace</title>
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/center.css">
    <link rel="stylesheet" href="../../css/topNav.css">
    <link rel="stylesheet" href="../../css/bottomNav.css">
    <link rel="stylesheet" href="../../css/grid.css">
    <link rel="stylesheet" href="../../css/setting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body class="fontInter">

    <?php
      if (isset($_GET['status']) && $_GET['status'] != 'success') {
        echo '<div class="popup">
        <img class="closeBtn" src="../../pic/icon/closeBtn_black.svg" alt="close-popup">';
        $status = $_GET['status'];
        if ($status == 'empty') {
          echo '<h2>Missing fields:</h2>
                <h3>Please enter all necessary fields.</h3>';
        } elseif ($status == 'email') {
          echo '<h2>Invalid email:</h2>
                <h3>Please enter a valid email address.</h3>';
        } elseif ($status == 'wrongpwd') {
          echo '<h2>Password Unmatched:</h2>
                <h3>Incorrect Password.</h3>';
        }
        echo '</div>';
      }
     ?>

     <section id="changePwdForm" class="topNav flex alignCenter justifyCenter">
       <nav class="flex justifyBetween alignCenter">
         <h2 class="logo">griefSpace</h2>
         <div class="linkContainer flex">
           <h5><a href="../../index.php">Home</a></h5>
           <h5 class="toggleFeature">Features</h5>
         </div>
         <div class="btnContainer">
           <?php
             if (!isset($_SESSION['uid'])) {
               echo '<button class="actionBtn" type="button"><h5><a href="../loginPage.php">Login</a></h5></button>';
             } else{
               echo '<form action="../../php/loginReg/login/logout.php" method="post">
                      <button class="actionBtn secondBtn logoutBtn" type="submit" name="logoutBtn"><h5>Logout</h5></button>
                     </form>';
             }
            ?>
         </div>
       </nav>
     </section>

     <nav class="hiddenFeature">
       <div class="linkContainer flex flexColumn alignCenter">
         <h5><a href="../journal/journal.php">Journal</a></h5>
         <h5><a href="../insight/insight.php">Insight</a></h5>
         <h5><a href="../setting/setting.php">Settings</a></h5>
       </div>
     </nav>

    <section class="changeForm settingConn container">
      <h1 class="heading">Change password</h1>
      <div class="wrapper">
        <form action="../../php/setting/account/changeEmail.php" method="post">
          <div class="textContainer">
            <h2 class="label">Enter password</h2>
            <div class="pwdContainer flex">
              <input type="password" name="pwd" placeholder="Enter password to proceed" value="">
              <button class="showPwdBtn" type="button">Show</button>
            </div>
          </div>
          <div class="textContainer">
            <h2 class="label">Repeat password</h2>
            <div class="pwdContainer flex">
              <input type="password" name="pwd" placeholder="Enter password to proceed" value="">
              <button class="showPwdBtn" type="button">Show</button>
            </div>
          </div>
          <button class="actionBtn" type="submit"><h5>Update</h5></button>
        </form>
      </div>

    </section>

    <!-- mobile bottom nav -->
    <section class="bottomNav">
      <nav class="flex justifyEven alignCenter">
        <div class="navButton flex justifyCenter alignCenter flexColumn">
          <a class="flex justifyCenter alignCenter flexColumn" href="../home.php">
            <svg id="homeNavBtn" width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.19994 18.7463L1.20503 18.7408L1.21004 18.7352L16.9509 1.24533C16.9514 1.24486 16.9518 1.24438 16.9522 1.2439C17.0222 1.1673 17.1074 1.10606 17.2023 1.06407C17.2978 1.02182 17.401 1 17.5054 1C17.6099 1 17.7131 1.02182 17.8086 1.06407C17.9035 1.10606 17.9887 1.1673 18.0587 1.2439C18.0591 1.24438 18.0595 1.24486 18.06 1.24533L33.8008 18.7352L33.8042 18.7389C33.9308 18.8782 34.0004 19.0602 33.999 19.2485V19.2558C33.999 19.4546 33.92 19.6452 33.7795 19.7857C33.639 19.9262 33.4484 20.0052 33.2496 20.0052H29.7509H28.7509V21.0052V33.2506C28.7509 33.4494 28.672 33.64 28.5314 33.7805C28.3909 33.9211 28.2003 34 28.0016 34H7.00933C6.81058 34 6.61998 33.9211 6.47945 33.7805C6.33892 33.64 6.25997 33.4494 6.25997 33.2506V21.0052V20.0052H5.25997L1.76127 20.0051L1.75446 20.0052C1.60822 20.0062 1.46488 19.9644 1.34212 19.8849C1.21936 19.8054 1.12253 19.6918 1.06358 19.5579C1.00463 19.4241 0.986128 19.2759 1.01036 19.1317C1.03459 18.9875 1.10049 18.8535 1.19994 18.7463Z" stroke="#525252" stroke-width="2"/>
            </svg>
            <p>Home</p>
          </a>
        </div>
        <div class="navButton ">
          <a class="flex justifyCenter alignCenter flexColumn" href="../journal/journal.php">
            <svg id="journalNavBtn" width="32" height="35" viewBox="0 0 32 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M29.7938 31.0399L29.8532 31.3368L30.0673 31.5509C30.3958 31.8794 30.4307 32.0775 30.4307 32.1562V33.25C30.4307 33.5111 30.3337 33.6829 30.2081 33.798C30.0695 33.925 29.8751 34 29.6807 34H7.36816C4.2017 34 1.80566 31.604 1.80566 28.4375V6.5625C1.80566 3.39603 4.2017 1 7.36816 1H29.6807C30.027 1 30.1867 1.09998 30.2587 1.17195C30.3307 1.24392 30.4307 1.40363 30.4307 1.75V24.5C30.4307 24.7235 30.3926 24.8323 30.3722 24.8731C30.3629 24.8916 30.3564 24.8983 30.3544 24.9003C30.3524   24.9023 30.3457 24.9088 30.3272 24.9181L29.9158 25.1238L29.8043 25.57C29.6605 26.1449 29.6104 27.25 29.6104 28.2461C29.6104 29.2618 29.6634 30.3876 29.7938 31.0399ZM26.8369 31.625H27.8369V30.625V26.25V25.25H26.8369H7.36816C5.78823 25.25 4.18066 26.5089 4.18066 28.4375C4.18066 29.321 4.47953 30.135 5.07512 30.7305C5.67071 31.3261 6.48467 31.625 7.36816 31.625H26.8369ZM19.9463 20.2344L19.9464 20.2344C20.2364 19.9443 20.3994 19.5509 20.3994 19.1406V16.3125H23.2275C23.6378 16.3125 24.0312   16.1495 24.3213 15.8594L23.6142 15.1523L24.3213 15.8594C24.6114 15.5693 24.7744 15.1759 24.7744 14.7656V11.4844C24.7744 11.0741 24.6114 10.6807 24.3213 10.3906L23.6142 11.0977L24.3213 10.3906C24.0312 10.1005 23.6378 9.9375 23.2275 9.9375H20.3994V7.10938C20.3994 6.69912 20.2364 6.30567 19.9463 6.01557L19.2392 6.72268L19.9463 6.01557C19.6562 5.72548 19.2628 5.5625 18.8525 5.5625H15.5713C15.161 5.5625 14.7676 5.72547 14.4775 6.01557C14.1874 6.30567 14.0244 6.69912 14.0244   7.10938V9.9375H11.1963C10.786 9.9375 10.3926 10.1005 10.1025 10.3906C9.81238 10.6807 9.64941 11.0741 9.64941 11.4844V14.7656C9.64941 15.1759 9.81238 15.5693 10.1025 15.8594C10.3926 16.1495 10.786 16.3125 11.1963 16.3125H14.0244V19.1406C14.0244 19.5509 14.1874 19.9443 14.4775 20.2344L15.1846 19.5273L14.4775 20.2344C14.7676 20.5245 15.161 20.6875 15.5713 20.6875H18.8525C19.2628 20.6875 19.6562 20.5245 19.9463 20.2344Z"
              stroke="#525252"
              stroke-width="2"/>
            </svg>
            <p>Journal</p>
         </a>
        </div>
        <div class="navButton flex justifyCenter alignCenter flexColumn ">
          <a class="flex justifyCenter alignCenter flexColumn" href="../insight/insight.php">
            <svg id="insightNavBtn" width="38" height="35" viewBox="0 0 38 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M36.9933 20.7674L36.9933 20.7677C36.4923 24.312 34.7847 27.4668 32.2986 29.809C32.2962 29.8112 32.2867 29.8202 32.2579 29.8191C32.2264 29.818 32.1958 29.8046 32.1745 29.7833L23.0786 20.6875H36.8856C36.9159 20.6875 36.9495 20.7011 36.9745 20.7286C36.9859 20.7411 36.9908 20.7516 36.9925 20.7568C36.993 20.7585 36.9934 20.7599 36.9936 20.7613C36.9938 20.7631 36.9937 20.7649 36.9933 20.7674ZM34.8058 15.3265L34.8058 15.3266L34.8058 15.3268C34.8061 15.3303 34.8071 15.3445 34.7846  15.3676C34.7597 15.3932 34.7267 15.4062 34.6967 15.4062H20.3998V1.10991C20.3998 1.07984 20.4129 1.04657 20.4386 1.02141C20.4618 0.998826 20.4759 0.999849 20.4791 1.00008L20.4793 1.00009L20.4794 1.0001C28.1477 1.52903 34.2769 7.65828 34.8058 15.3265ZM15.1185 19.6875V20.1016L15.4114 20.3945L26.066 31.0498L26.066 31.0499C26.0885 31.0723 26.1013 31.1052 26.0993 31.1394C26.0983 31.155 26.0945 31.1641 26.0928 31.1675L26.0927 31.1675C26.0918 31.1693 26.0912 31.1704 26.0875 31.173L26.0872   31.1732C23.6292 32.9168 20.6418 33.9584 17.4069 33.9988L17.4068 33.9988C9.18568 34.1021 2.09432 27.3467 1.81481 19.1319C1.54268 11.124 7.38808 4.43971 15.0389 3.35858L15.0393 3.35851C15.0436 3.3579 15.0456 3.35815 15.0492 3.35932C15.0543 3.361 15.0648 3.3658 15.0773 3.37722C15.1048 3.40229 15.1185 3.436 15.1185 3.46628V19.6875Z"
              stroke="#525252"
              stroke-width="2"/>
            </svg>
            <p>Insight</p>
          </a>
        </div>
        <div class="navButton flex justifyCenter alignCenter flexColumn active">
          <a class="flex justifyCenter alignCenter flexColumn" href="../setting/setting.php">
            <svg id="settingNavBtn" class="active" width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M29.8938 19.7875L29.765 20.4823L30.377 20.8357L33.2878 22.5166C32.5574 24.8072 31.3431 26.8783 29.7649 28.6092L26.8681 26.9364L26.2575 26.5838L25.7203 27.0404C24.5421 28.042 23.1942 28.8204 21.7424 29.3371L21.0777 29.5736V30.2792V33.6267C18.8262 34.1123 16.4088 34.1364 14.0455 33.6267V30.2792V29.5696L13.3756 29.3353C11.9203 28.8262 10.5758 28.0496 9.40734 27.0443L8.8695 26.5816L8.25508 26.9364L5.3585 28.6091C3.78034 26.8717 2.56653 24.8014 1.83627 22.5191L4.73912 20.8428L5.35108 20.4894L5.2223 19.7946C4.9412 18.2779 4.9412 16.7221 5.2223 15.2054L5.35108 14.5106L4.73912 14.1572L1.83618 12.4809C2.56659 10.1913 3.7806 8.12114 5.35821 6.39091L8.24715 8.06309L8.85798 8.41666L9.39575 7.95956C10.574 6.95803 11.9219 6.17956 13.3737 5.66294L14.0384 5.42639V4.72081V1.37333C16.2899 0.887655 18.7073 0.863588 21.0706 1.37334V4.71376V5.42339L21.7405 5.65768C23.1958 6.16673 24.5403 6.94333 25.7088 7.94862L26.2466 8.41135L26.861 8.05655L29.7576 6.38387C31.3358 8.12121 32.5496 10.1916 33.2798 12.4739L30.377 14.1502L29.765 14.5035L29.8938 15.1984C30.1749 16.715 30.1749 18.2709 29.8938 19.7875ZM10.9094 17.4929C10.9094 21.1571 13.8904 24.1381 17.5545 24.1381C21.2187 24.1381 24.1997 21.1571 24.1997 17.4929C24.1997 13.8288 21.2187 10.8478 17.5545 10.8478C13.8904 10.8478 10.9094 13.8288 10.9094 17.4929Z"
              stroke="#525252"
              stroke-width="2"/>
            </svg>
            <p>Settings</p>
          </a>
        </div>
      </nav>
    </section>
  </body>
  <script type="text/javascript" src="../../js/login/showPwd.js"></script>
  <script src="../../js/popupConn.js"></script>
  <script src="../../js/toggleFeature.js"></script>
</html>
