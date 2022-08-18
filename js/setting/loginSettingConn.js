const clickLoginSetting = () => {
  const allLoginSettings = document.querySelectorAll('.loginSettingBtn');
  allLoginSettings.forEach((btn, index) => btn.addEventListener('click', () => {
    loginSettingXhr(allLoginSettings, index);
  }));

}

var loginSettingArr = [];

const loginSettingXhr = (allLoginSettings, index) => {
  let targetText = allLoginSettings[index].querySelector('.indicatorContainer').querySelector('h5').innerText.toLowerCase().trim();
  if (loginSettingArr.includes(targetText)){
    loginSettingArr = loginSettingArr.filter(ele => ele != targetText);
  } else{
    loginSettingArr.push(targetText);
  }
  
  let paramStr = `param=${JSON.stringify(loginSettingArr)}`;
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../php/setting/loginSetting/updateLoginSetting.php", true);
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

const getEnabledLoginSetting = () => {
  const allLoginSettings = document.querySelectorAll('.loginSettingBtn');
  allLoginSettings.forEach(btn => btn.classList.contains('selected') ? loginSettingArr.push(btn.querySelector('h5').innerText.toLowerCase().trim()) : '');
}

const fetchLoginSetting = () => {
  const xhr = new XMLHttpRequest();
  let paramStr = "param=fetchLoginSetting";
  xhr.open("POST", "../../php/setting/loginSetting/getLoginSetting.php", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    if (this.status == 200) {
      let res = JSON.parse(this.responseText);
      if ('login_alert' in res && 'one_time_pwd' in res) {
        let isLoginAlert = res.login_alert;
        let isOntTimePwd = res.one_time_pwd;
        if (isLoginAlert == 1) {
          loginSettingArr.push("alert after login");
        }
        if (isOntTimePwd == 1) {
          loginSettingArr.push("one-time password");
        }
        changeLoginSwitchState(isLoginAlert, isOntTimePwd);
      } else{
        location.href = "../../index.php?setting=error";
      }
    } else{
      location.href = "../../index.php?setting=error";
    }
  }
  xhr.send(paramStr);
}

const changeLoginSwitchState = (isLoginAlert, isOntTimePwd) => {
  if (isLoginAlert == 1) {
    const loginAlert = document.querySelector('#loginAlert');
    const settingSwitch = document.querySelector('#loginAlert').querySelector('.switch');
    const settingCircle = settingSwitch.querySelector('.circle');
    loginAlert.classList.add('selected');
    settingSwitch.classList.add('activatedSwtch');
    settingCircle.classList.add('activatedCircle');
  }
  if (isOntTimePwd == 1) {
    const oneTimePwd = document.querySelector('#oneTimePwd');
    const settingSwitch = document.querySelector('#oneTimePwd').querySelector('.switch');
    const settingCircle = settingSwitch.querySelector('.circle');
    oneTimePwd.classList.add('selected');
    settingSwitch.classList.add('activatedSwtch');
    settingCircle.classList.add('activatedCircle');
  }
}

clickLoginSetting();
getEnabledLoginSetting();
fetchLoginSetting();
