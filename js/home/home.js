const homeDivLink = () => {
  const journalLink = document.querySelector('#journalLink');
  const insightLink = document.querySelector('#insightLink');

  journalLink.addEventListener('click', () => location.href="./journal/journal.php");
  insightLink.addEventListener('click', () => location.href="./insight/insight.php");
}

homeDivLink();
