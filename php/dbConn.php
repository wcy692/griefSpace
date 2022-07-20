<?php

  function pdoConn(){
    $dsn = 'mysql:host=localhost;dbname=griefspace';
    $username = 'root';
    $pwd = '';
    try {
        return $dbh = new PDO($dsn, $username, $pwd);
      } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
  }

 ?>
