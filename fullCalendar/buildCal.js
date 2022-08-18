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
    events: '../test/load.php',
  });
  calendar.render();
});

const fetch = () => {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', '../test/load.php', true);
  xhr.onload = function(){
    if (this.status == 200) {
      let res = this.responseText;
      console.log(res);
    }
  }
  xhr.send();
}

fetch();
