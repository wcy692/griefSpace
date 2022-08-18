const slideConn = () => {
  const toggleAccount = document.querySelector('#toggleAccount');
  const togglePush = document.querySelector('#togglePush');
  const toggleLogin = document.querySelector('#toggleLogin');
  const allGoBack = document.querySelectorAll('.backToSetting');

  toggleAccount.addEventListener('click', accountIn);
  togglePush.addEventListener('click', pushIn);
  toggleLogin.addEventListener('click', loginSettingIn);
  allGoBack.forEach(btn => btn.addEventListener('click', settingConnIn));

}

const accountIn = () => {
  allSlidesOut();
  const account = document.querySelector('#account');
  account.style.left = '0';
  account.style.pointerEvents = 'auto';
}

const pushIn = () => {
  allSlidesOut();
  const push = document.querySelector('#push');
  push.style.left = '0';
  push.style.pointerEvents = 'auto';
}

const loginSettingIn = () => {
  allSlidesOut();
  const loginSetting = document.querySelector('#loginSetting');
  loginSetting.style.left = '0';
  loginSetting.style.pointerEvents = 'auto';
}

const settingConnIn = () => {
  allSlidesOut();
  const settingConn = document.querySelector('#settingConn');
  settingConn.style.left = '0';
  settingConn.style.pointerEvents = 'auto';
}

const allSlidesOut = () => {
  const allSildes = document.querySelectorAll('.slide');
  allSildes.forEach(slide => {
    slide.style.left = '-150%';
    slide.style.pointerEvents = 'none';
  });
}

slideConn();
