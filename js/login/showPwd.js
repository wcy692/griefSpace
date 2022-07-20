const showPwdConn = () => {
  const pwdInputs = document.querySelectorAll("input[type='password']");
  const showPwdBtns = document.querySelectorAll('.showPwdBtn');
  let isShow = false;

  const toggleShow = () => {
    pwdInputs.forEach(input => isShow ? input.type = 'password' : input.type = 'text');
  }

  const changeBtnText = () => {
    showPwdBtns.forEach(pwdBtn => isShow ? pwdBtn.innerHTML = 'Show' : pwdBtn.innerHTML = 'Hide');
  }

  showPwdBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      toggleShow();
      changeBtnText();
      isShow = !isShow;
    });
  });

}

showPwdConn();
