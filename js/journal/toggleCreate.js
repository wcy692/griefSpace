const toggleCreate = () => {
  const createBtn = document.querySelector('.createBox');
  createBtn.addEventListener('click', () => {
    location.href = './modal.php';
  })
}

const fetchAllJournal = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../../php/journal/fetchAllJournal.php", true);
  xhr.onload = function(){
    if (this.responseText != null) {
      let res = JSON.parse(this.responseText);
      const boxWrapper = document.querySelector('.boxWrapper');
      let titleArr = res[0];
      let timeArr = res[1];
      let journalIdArr = res[2];
      let data = '';
      for (let i = 0; i < titleArr.length; i++) {
        data += `<div class="box journalBox">
                  <div class="preview"></div>
                  <div class="desc flex justifyBetween">
                    <div class="textContainer">
                      <h2 class="title">${titleArr[i]}</h2>
                      <p>Last update:<br> ${timeArr[i]}</p>
                      <input type="hidden" name="journal_id" value="${journalIdArr[i]}">
                    </div>
                  </div>
                </div>`;
      }
      if (boxWrapper != null) {
        boxWrapper.innerHTML += data;
        const journalBoxes = document.querySelectorAll('.journalBox');
        toggleCreate();
        readJournalBox(journalBoxes);
      }
    }
  }
  xhr.send();
}

const readJournalBox = (boxes) => {
  boxes.forEach((box, i) => box.addEventListener('click', (e) => {
    const inputs = document.querySelectorAll("input[name=journal_id]");
    location.href = `./preview.php?journal=${inputs[i].value}`;
  }));
}

fetchAllJournal();
