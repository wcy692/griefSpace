const changeForm = () => {
  const wrapper = document.querySelector(".wrapper");
  const loginForm = document.querySelector(".loginForm");
  const regForm = document.querySelector(".regForm");
  const toggleFormBtns = document.querySelectorAll(".toggleFormBtn");
  let showLogin = true;

  toggleFormBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      updateForm();
      showLogin = !showLogin;
    })
  });

  const updateForm = () => {
    if (showLogin) {
      wrapper.classList.remove('loginWrapper');
      wrapper.classList.add('regWrapper');
      regForm.classList.add('activeForm');
      loginForm.classList.remove('activeForm');
    } else{
      wrapper.classList.remove('regWrapper');
      wrapper.classList.add('loginWrapper');
      loginForm.classList.add('activeForm');
      regForm.classList.remove('activeForm');
    }
  }

}

changeForm();
