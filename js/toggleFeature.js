const featureIn = () => {
  const toggleFeature = document.querySelector('.toggleFeature');
  const hiddenFeature = document.querySelector('.hiddenFeature');
  let isToggled = false;
  toggleFeature.addEventListener('click', () => {
    if (!isToggled) {
      hiddenFeature.style.top = '11vh';
      hiddenFeature.style.opacity = '1';
    } else{
      hiddenFeature.style.top = '9vh';
      hiddenFeature.style.opacity = '0';
    }
    isToggled = !isToggled;
  })
}

const setDeaultProperty = () => {
  const toggleFeature = document.querySelector('.toggleFeature');
  const hiddenLink = document.querySelector('.hiddenFeature .linkContainer');
  const hiddenFeature = document.querySelector('.hiddenFeature');

  let rect = toggleFeature.getBoundingClientRect();
  let targetLeft = rect.left;
  let targetRight = rect.right;
  let width = rect.width;

  hiddenLink.style.width = `${width * 2}px`;
  hiddenFeature.style.left = `${targetLeft}px`;
  hiddenFeature.style.transform = `translateX(-${width/2}px)`;
}

featureIn();
setDeaultProperty();
