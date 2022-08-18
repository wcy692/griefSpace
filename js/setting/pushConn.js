const clickNotiBtn = () => {
  const allNotiBtns = document.querySelectorAll('.notiBtn');
  allNotiBtns.forEach((btn, index) => btn.addEventListener('click', () => {
    updateXhr(allNotiBtns, index);
  }));

}

var settingPush = [];

const updateXhr = (allNotiBtns, index) => {
  let targetText = allNotiBtns[index].querySelector('h5').innerText.toLowerCase().trim();
  if (settingPush.includes(targetText)){
    settingPush = settingPush.filter(ele => ele != targetText);
  } else{
    settingPush.push(targetText);
  }

  let paramStr = `param=${JSON.stringify(settingPush)}`;
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../php/setting/pushNotification/updateNotification.php", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    if (this.status == 200) {
      let res = JSON.parse(this.responseText);
      if ('update' in res && res.update == 'error') {
        location.href = "../../index.php?setting=error";
      } else if('update' in res && res.update == 'invalid') {
        location.href = "../../index.php?setting=error";
      }
    } else{
      location.href = "../../index.php?setting=error";
    }
  }
  xhr.send(paramStr);
}

const getEnabledSetting = () => {
  const allNotiBtns = document.querySelectorAll('.notiBtn');
  allNotiBtns.forEach(btn => btn.classList.contains('selected') ? settingPush.push(btn.querySelector('h5').innerText.toLowerCase().trim()) : '');
}

const fetchSetting = () => {
  const xhr = new XMLHttpRequest();
  let paramStr = "param=fetchsetting";
  xhr.open("POST", "../../php/setting/pushNotification/getNotification.php", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    if (this.status == 200) {
      let res = JSON.parse(this.responseText);
      if ('journal_created' in res && 'journal_updated' in res) {
        let isJournalCreated = res.journal_created;
        let isJournalUpdated = res.journal_updated;
        changeSwitchState(isJournalCreated, isJournalUpdated);
        if (isJournalCreated == 1) {
          settingPush.push("journal created");
        }
        if (isJournalUpdated == 1) {
          settingPush.push("journal updated");
        }
      } else{
        location.href = "../../index.php?setting=error";
      }
    } else{
      location.href = "../../index.php?setting=error";
    }
  }
  xhr.send(paramStr);
}

const changeSwitchState = (isJournalCreated, isJournalUpdated) => {
  if (isJournalCreated == 1) {
    const journal_created = document.querySelector('#journal_created');
    const notiSwitch = document.querySelector('#journal_created').querySelector('.switch');
    const notiCircle = notiSwitch.querySelector('.circle');
    journal_created.classList.add('selected');
    notiSwitch.classList.add('activatedSwtch');
    notiCircle.classList.add('activatedCircle');
  }
  if (isJournalUpdated == 1) {
    const journal_updated = document.querySelector('#journal_updated');
    const notiSwitch = document.querySelector('#journal_updated').querySelector('.switch');
    const notiCircle = notiSwitch.querySelector('.circle');
    journal_updated.classList.add('selected');
    notiSwitch.classList.add('activatedSwtch');
    notiCircle.classList.add('activatedCircle');
  }
}

clickNotiBtn();
getEnabledSetting();
fetchSetting();
