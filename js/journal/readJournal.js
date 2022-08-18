const getThisJournal = () => {
  let journalId = getJournalId();
  let questionId = getQuestionId();
  if (questionId == null) {
    questionId = -1;
  }

  let xhr = new XMLHttpRequest();
  // let param = `journalId=${journalId}`;
  let param = `param=journalId=${journalId};selectedId=${questionId}`;
  xhr.open("POST", "../../php/journal/getJournalContent.php", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (this.status == 200) {
      let res = '';
      if (this.responseText == null || this.responseText == 'invalid') {
        location.href = './journal.php';
      } else{
        res = JSON.parse(this.responseText);
      }
      // rendering handler for topText in the preview.php and detail.php pages
      const previewHeading = document.querySelector('#previewPanel .previewHeading');
      let previewText = '';
      previewText =  `  <div class="desc">
                          <h3>Title: </h3>
                          <h2>${res[0]}</h2>
                          <h3>Emotion: </h3>
                          <h2>#${res[1][0].toUpperCase()}${res[1].substring(1).trim()}</h2>
                        </div>`;
      if (previewHeading != null) {
          previewHeading.innerHTML = previewText;
      }

      const detailHeading = document.querySelector('#previewPanel .detailHeading');
      if (detailHeading != null) {
        previewText += `<h3>Question: </h3>
                        <h2>${res[2][0][0].toUpperCase()}${res[2][0].substring(1).trim()}</h2>`;

        detailHeading.innerHTML = previewText;
      }

      let questionArr = res[2];
      let ansArr = res[3];
      let questionIdArr = res[4];

      let uniqQuestionArr = [ ...new Set(questionArr) ];
      // rendering handler for boxes in the preview.php page
      const boxWrapper = document.querySelector('.boxWrapper');
      if (boxWrapper != null) {
        let boxText = '';
        uniqQuestionArr.forEach((question, i) => {
          questionText = question[0].toUpperCase() + question.substring(1).trim();
          boxText += `<div class="box">
                        <div class="preview flex justifyCenter alignCenter">
                          <div class="desc flex justifyCenter alignCenter"><h2 class="question">${questionText}</h2></div>
                        </div>
                      </div>`;
        });
        boxWrapper.innerHTML = boxText;
        viewAns(journalId, questionIdArr);
      }

      const ansPreview = document.querySelector('#previewPanel .ansPreview');
      const ansCount = document.querySelector('#previewPanel .ansCount');
      if (ansPreview != null && ansCount != null) {
        let ansText = '';
        ansCount.innerText = `You've submited ${ansArr.length} answers for this question.`;
        ansArr.forEach((ans, i) => {
          ansText += `<h3>Answer ${i + 1}:</h3><h2>${ans}</h2>`;
        });
        ansPreview.innerHTML += ansText;
      }

      goToEditPanel(journalId);
    }
  }
  xhr.send(param);
}

const getJournalId = () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  return journalId = urlParams.get('journal');
}

const getQuestionId = () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  return questionId = urlParams.get('question');
}

const viewAns = (journalId, questionIdArr) => {
  const previewBoxs = document.querySelectorAll('.boxWrapper .box');
  if (previewBoxs != null) {
    previewBoxs.forEach((box, i) => box.addEventListener('click', () => {
      location.href = `./detail.php?journal=${journalId}&question=${questionIdArr[i]}`;
    }));
  }
}

const goToEditPanel = (journalId) => {
  const editBtn = document.querySelector('.editBtn');

  editBtn.addEventListener('click', () => {
    location.href = `./editPanel.php?journal=${journalId}`;
  })
}

const goBack = () => {
  const quitBtn = document.querySelector("#quitBtn");
  let journalId = getJournalId();
  let path = getPathName();

  if (quitBtn != null) {
    quitBtn.addEventListener('click', () => {
      if (path.indexOf('preview') != -1) {
        location.href = `./journal.php`;
      } else if(path.indexOf('detail') != -1){
        location.href = `./preview.php?journal=${journalId}`;
      } else{
        location.href = `./journal.php`;
      }
      // location.href = `./preview.php?journal=${journalId}`;
    })
  }
}

const getPathName = () => {
  return window.location.pathname;
}

getThisJournal();
goBack();
getPathName();
