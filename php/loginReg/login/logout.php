<?php

  if (isset($_POST['logoutBtn'])) {
    // echo $_SERVER['HTTP_REFERER'];
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../../../index.php");
  } else{
    echo 'not';
  }


 ?>
