<?php

  require_once '../test/dbConn.php';
  $pdo = pdoConn();

  $sql = "SELECT DISTINCT emotion_id, createTime FROM journal_basic WHERE userdata_id=33;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetchAll();

  $timeArr = array();
  foreach ($row as $ele) {
    // push into timeArr
    $timeArr[] =  $ele['createTime'];

    //get emotion names using its id
    $emotion_id = (int)$ele['emotion_id'];
    $sql = "SELECT context FROM emotion WHERE id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1,$emotion_id , PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $emotionArr[] = $row[0]['context'];
  }

  $search = ['terrible', 'bad', 'neutral', 'good', 'amazed'];
  $replace = ['#B26B45', '#256FFF', '#f4eacd', '#feff24', '#FD6C2E'];
  $colours = str_replace($search, $replace, $emotionArr);

  $format = 'U';
  $timezone = new DateTimeZone('Europe/London');
  $dateArr = array();

  foreach ($timeArr as $ele) {
    $dateTime = DateTime::createFromFormat($format, $ele);
    $dateTime->setTimezone($timezone);
    $dateArr[] = $dateTime->format('Y-m-d');
  }

  print_r($dateArr);
  print_r($colours);
 ?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='main.css' rel='stylesheet'/>
    <script src='main.js'></script>
    <!-- <script src='buildCal.js'></script> -->
    <link href='../css/calendar.css' rel='stylesheet' />
  </head>
  <body>
    <div class="container">
      <div id='calendar'></div>
    </div>
  </body>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      navLinks: true,
      headerToolbar: {
        start: 'prev next today',
        center: 'title',
        end: ''
      },
      dateClick: function(info){
        console.log(info);
      },
      events: [
        <?php
          for ($i=0; $i < count($dateArr); $i++) {
        ?>
          {
            title: `<?php echo $emotionArr[$i]?>`,
            display: 'background',
            backgroundColor: `<?php echo $colours[$i]?>`,
            start: `<?php echo $dateArr[$i]?>`,
            end: `<?php echo $dateArr[$i]?>`,
          },
        <?php } ?>
      ],

    });
    calendar.render();
  });
  </script>
</html>
