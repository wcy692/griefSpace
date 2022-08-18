const popupIn = () => {
  const popup = document.querySelector(".popup");
  if (popup != null) {
    popup.style.bottom = "0";
    popupClose(popup);
  }
}

const popupClose = (popup) => {
  const popupCloseBtn = document.querySelector(".popup .closeBtn");
  popupCloseBtn.addEventListener('click', () => popup.style.bottom = "-100%");
}

window.onload = (event) => {
  popupIn();
};
