export function getJournalId(info){
  let dateStr = `dateStr=${info.dateStr}`;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", '../../php/insight/getJournalPath.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    if (this.status == 200) {
      let res = this.responseText;
      if (res.length > 0) {
        location.href = `../journal/preview.php?journal=${res}`;
      }
    }
  }
  xhr.send(dateStr);
}
