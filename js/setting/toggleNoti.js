const notiBtns = document.querySelectorAll('.notiBtn');
const switchs = document.querySelectorAll('.notiBtn .switch');
const circles = document.querySelectorAll('.notiBtn .circle');

const enableNoti = () => {
    notiBtns.forEach((btn, index) => btn.addEventListener('click', () => (!btn.classList.contains('selected')) ? notiBtnOn(index) : notiBtnOff(index)));
}

const notiBtnOn = (index) => {
  notiBtns[index].classList.add('selected');
  switchs[index].classList.add('activatedSwtch');
  circles[index].classList.add('activatedCircle');
}

const notiBtnOff = (index) => {
  notiBtns[index].classList.remove('selected');
  switchs[index].classList.remove('activatedSwtch');
  circles[index].classList.remove('activatedCircle');
}

enableNoti();
