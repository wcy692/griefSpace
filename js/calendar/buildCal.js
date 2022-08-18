

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 'auto',
    aspectRatio: 1,
    dateClick: function(info) {
      let d = new Date();
      console.log(`${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`);
      // setDayStr(info);
    },
    headerToolbar: {
      start: 'prev',
      center: 'title',
      end: 'next'
    }
  });
  calendar.render();
});

// event obj template
// start: '2022-08-06',
// end: '2022-08-06',
// display: 'background',
// backgroundColor: '#FD6C2E'

const fetchEvent = () => {
  xhr('all');
}

const setDayStr = (info) => {
  let dateStr = info.dateStr;
  xhr(dateStr)
}

const xhr = (dateStr) => {
  const xhr = new XMLHttpRequest();

  let param = `date=${dateStr}`;
  xhr.open('POST', '../../php/insight/insight.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    if (this.status == 200) {
      let res = JSON.parse(this.responseText);
      var calendarEl = document.getElementById('calendar');

      console.log(calendarEl);
      let timeArr = filterExisted(res['timeArr']);
      let emotionArr = filterExisted(res['emotionArr']);
    } else{

    }
  }
  xhr.send(param);

}

const filterExisted = (arr) => {
  return unique = [ ...new Set(arr)];
}

fetchEvent();
