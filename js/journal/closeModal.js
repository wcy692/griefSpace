const closeModal = () => {
  const closeJournalBtn = document.querySelector('#closeJournalBtn');
  closeJournalBtn.addEventListener('click', showFloat);
}

const showFloat = () => {
  const floatWin = document.querySelector('.floatWin');
  const darkenBg = document.querySelector('.darkenBg');

  floatWin.style.opacity = '1';
  floatWin.style.pointerEvents = 'auto';
  darkenBg.style.display = 'block';

}

const closeFloat = () => {
  const floatWin = document.querySelector('.floatWin');
  const darkenBg = document.querySelector('.darkenBg');

  floatWin.style.opacity = '0';
  floatWin.style.pointerEvents = 'none';
  darkenBg.style.display = 'none';
}

const cancel = () => {
  const cancelBtn = document.querySelector('#cancelBtn');

  cancelBtn.addEventListener('click', closeFloat);
}

const redirect = () => {
  const discardBtn = document.querySelector('#discardBtn');

  discardBtn.addEventListener('click', () => location.href = './journal.php');
}

closeModal();
cancel();
redirect();
