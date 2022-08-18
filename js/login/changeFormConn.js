const changeForm = () => {
  const wrapper = document.querySelector(".wrapper");
  const loginForm = document.querySelector(".loginForm");
  const regForm = document.querySelector(".regForm");
  const toggleFormBtns = document.querySelectorAll(".toggleFormBtn");
  const formContainer = document.querySelector(".formContainer");
  const loginSwiperReminder = document.querySelector(".loginSwiperReminder");
  let showLogin = true;

  toggleFormBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      updateForm(formContainer, loginSwiperReminder);
      showLogin = !showLogin;
    })
  });

  const updateForm = (formContainer, loginSwiperReminder) => {
    if (showLogin) {
      wrapper.classList.remove('loginWrapper');
      wrapper.classList.add('regWrapper');
      regForm.classList.add('activeForm');
      loginForm.classList.remove('activeForm');
      formContainer.style.margin = '4vh auto 0 auto';
      if (loginSwiperReminder != null) {
        loginSwiperReminder.style.margin = '0 auto';
      }
    } else{
      wrapper.classList.remove('regWrapper');
      wrapper.classList.add('loginWrapper');
      loginForm.classList.add('activeForm');
      regForm.classList.remove('activeForm');
      formContainer.style.margin = '6vh auto 10vh auto';
      if (loginSwiperReminder != null) {
        loginSwiperReminder.style.margin = '4vh auto';
      }
    }
  }

}

changeForm();
