const loginSettingBtn = document.querySelectorAll('.loginSettingBtn');
const loginSwitchs = document.querySelectorAll('.loginSettingBtn .switch');
const loginCircles = document.querySelectorAll('.loginSettingBtn .circle');

const enableLoginSetting = () => {
    loginSettingBtn.forEach((btn, index) => btn.addEventListener('click', () => (!btn.classList.contains('selected')) ? loginSwitchOn(index) : loginSwitchOff(index)));
}

const loginSwitchOn = (index) => {
  loginSettingBtn[index].classList.add('selected');
  loginSwitchs[index].classList.add('activatedSwtch');
  loginCircles[index].classList.add('activatedCircle');
}

const loginSwitchOff = (index) => {
  loginSettingBtn[index].classList.remove('selected');
  loginSwitchs[index].classList.remove('activatedSwtch');
  loginCircles[index].classList.remove('activatedCircle');
}

enableLoginSetting();
