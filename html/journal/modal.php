<?php
  session_start();

  if (!isset($_SESSION['uid'])) {
    header("Location:../loginPage.php");
    exit();
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create journal in a secure way | griefSpace</title>
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/center.css">
    <link rel="stylesheet" href="../../css/topNav.css">
    <link rel="stylesheet" href="../../css/bottomNav.css">
    <link rel="stylesheet" href="../../css/grid.css">
    <link rel="stylesheet" href="../../css/modal.css">
    <link rel="stylesheet" href="../../css/editPanel.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body class="fontInter">

    <div class="floatWin flex flexColumn alignCenter">
      <h3 class="heading">Warning</h3>
      <div class="desc">
        <h3>Any unsaved data will be lost if you exit this edit panel.</h3>
        <h3>Are you sure to proceed?</h3>
      </div>
      <div class="btnContainer flex justifyBetween">
        <button id="cancelBtn" type="button" name="button"><h3>Cancel</h3></button>
        <div class="flex">
          <button id="discardBtn" type="button" name="button"><h3>Discard</h3></button>
          <button id="saveBtn" type="button" name="button"><h3>Save</h3></button>
        </div>
      </div>
    </div>

    <div class="darkenBg"></div>

    <section id="createModal" class="modal container">
      <div class="popup"><img class="closeBtn" src="../../pic/icon/closeBtn_black.svg" alt="close-popup">
        <h2></h2>
        <h3></h3>
      </div>

      <div class="warning"></div>

      <div class="transitionSlide hiddenSlide purple"></div>

      <section class="topNav flex alignCenter justifyCenter">
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

      <div id="questionConn" class="container">
        <div class="selectorWrapper">
          <div class="rightBtnContainer flex">
            <img id="quitBtn" src="../../pic/icon/goBack.svg" alt="quit-question-selector">
          </div>
          <div class="transitionSlide selectQuestion">
            <h1 class="heading">Choose your question</h1>
            <div class="question">
              <h5>Present</h5>
              <h3 class="option">What’s in your mind today?</h3>
            </div>
            <div class="question">
              <h5>Memories</h5>
              <h3 class="option">Your greatest gift was...</h3>
              <h3 class="option">The memory which is the most fond treasure...</h3>
              <h3 class="option">The memory which still struggles me the most...</h3>
            </div>
            <div class="question">
              <h5>Pride and Guilt</h5>
              <h3 class="option">The pride I wanna talk about...</h3>
              <h3 class="option">The guilt I wanna talk about...</h3>
            </div>
            <div class="question">
              <h5>Hypothetic</h5>
              <h3 class="option">Something I wanna ask about...</h3>
              <h3 class="option">If you would say something to me now, it would be...</h3>
            </div>
            <div class="question">
              <h5>Future</h5>
              <h3 class="option">The one thing that I will still remember...</h3>
            </div>
          </div>
        </div>

        <div class="rightBtnContainer flex"><img id="closeJournalBtn" src="../../pic/icon/closeBtn.svg" alt="discard-journal"></div>

        <!-- wrapper begin -->
        <div class="question-wrapper">
          <!-- emotion session -->
          <div id="emotionSlide" class="slide basic">
            <div class="head">
              <h1 class="heading">Give a new title</h1>
              <input class="editTitle" type="text" name="title" value="Title">
              <h1 class="heading">How are you doing today?</h1>
            </div>
            <div class="emotionPanel flex justifyCenter alignCenter">
              <div class="selector flex alignCenter flexColumn">
                <img src="../../pic/icon/emotion/terrible.svg" alt="terrible">
                <h3>Terrible</h3>
              </div>
              <div class="selector flex alignCenter flexColumn">
                <img src="../../pic/icon/emotion/bad.svg" alt="bad">
                <h3>Bad</h3>
              </div>
              <div id="neutralEmotion" class="selector flex alignCenter flexColumn">
                <img src="../../pic/icon/emotion/neutral.svg" alt="neutral">
                <h3>Neutral</h3>
              </div>
              <div class="selector flex alignCenter flexColumn">
                <img src="../../pic/icon/emotion/happy.svg" alt="happy">
                <h3>Good</h3>
              </div>
              <div class="selector flex alignCenter flexColumn">
                <img src="../../pic/icon/emotion/amazed.svg" alt="amazed">
                <h3>Amazed</h3>
              </div>
            </div>
            <div class="rightBtnContainer flex">
              <button id="emotionSub" class="flex alignCenter nextBtn" type="button"><h5>Next</h5><img src="../../pic/icon/arrow.svg" alt="next"></button>
            </div>
            <!-- emotion form: hidden form -->
            <form id="emotionForm" action="" method="post">
              <input type="radio" name="emotion" value="terrible">
              <input type="radio" name="emotion" value="bad">
              <input id='neutralRadio' type="radio" name="emotion" value="neutral">
              <input type="radio" name="emotion" value="good">
              <input type="radio" name="emotion" value="amazed">
            </form>
          </div>

          <!-- emotion session -->
          <div class="slide questionSlide">
            <div class="head">
               <div class="question flex justifyBetween alignBottom">
                 <div>
                   <h3 class="label">Title: </h3>
                   <h2 class="journalTitle"></h2>
                 </div>
                 <button class="editBtn editBasic" type="button"><img src="../../pic/icon/edit.svg" alt="edit-question"></button>
               </div>
               <div class="question editEmotion flex justifyBetween alignBottom">
                 <div>
                   <h3 class="label">Emotions: </h3>
                   <h2 class="emotionDisplay">#Neutral</h2>
                 </div>
                 <button class="editBtn editBasic" type="button"><img src="../../pic/icon/edit.svg" alt="edit-emotion"></button>
              </div>
              <div class="question editQuestion flex justifyBetween alignBottom">
                 <div class="questionContainer">
                   <h3 class="label">Question: </h3>
                   <h2 class="questionDisplay">What’s in your mind today?</h2>
                </div>
                <button class="editBtn" type="button"><img src="../../pic/icon/edit.svg" alt="edit-question"></button>
              </div>
            </div>
            <form class="textAreaForm flex justifyCenter" action="" method="post">
                <textarea name="ansText" rows="13" placeholder="Tap to edit"></textarea>
            </form>
            <div class="bottomBtns flex alignBottom justifyBetween">
                <div class="left">
                    <button id="saveBtn" class="flex justifyEnd alignCenter prevBtn" type="button"><img src="../../pic/icon/arrow.svg" alt="previous-entry"><h5>Before</h5></button>
                </div>
                <div class="right flex flexColumn">
                    <button class="flex justifyBetween alignCenter addQuestion inactive" type="button"><h5>Add Question</h5><img src="../../pic/icon/plus.svg" alt="add-question"></button>
                    <button class="flex justifyBetween alignCenter saveBtn inactive" type="button"><h5>Save</h5><img src="../../pic/icon/ok.svg" alt="save-and-exit"></button>
                </div>
            </div>
          </div>

        </div>

      </div>
    </section>
  </body>
  <script src="../../js/journal/insertJournalData.js"></script>
  <script src="../../js/journal/closeModal.js"></script>
  <script src="../../js/toggleFeature.js"></script>
</html>
