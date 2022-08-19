<?php

  function pdoConn(){
    $dsn = 'mysql:host=eu-cdbr-west-03.cleardb.net;dbname=heroku_747f91e40ccaa1d';
    $username = 'bc5b470f47717d';
    $pwd = '5bce9b98';
    // $url = parse_url(getenv("mysql://bc5b470f47717d:5bce9b98@eu-cdbr-west-03.cleardb.net/heroku_747f91e40ccaa1d?reconnect=true"));
    //
    // $server = $url["host"];
    // $username = $url["user"];
    // $password = $url["pass"];
    // $db = substr($url["path"], 1);
    // $dsn = "mysql:host=$server;dbname=$db";

    try {
        return $dbh = new PDO($dsn, $username, $pwd);
      } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
  }

 ?>
