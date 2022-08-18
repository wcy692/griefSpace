const getJournalId = () => {
  const url = new URL(location.href);
  return url.searchParams.get('journal');
}

const getTemplate = () => {
   return `<div class="head">
                    <div class="question flex justifyBetween alignBottom">
                      <div>
                        <h3 class="label">Title: </h3>
                        <h2 class="journalTitle"></h2>
                      </div>
                      <button class="editBtn editBasic" type="button"><img src="../../pic/icon/edit.svg" alt="edit-question"></button>
                    </div>
                    <div class="question editEmotion flex justifyBetween alignBottom">
                      <div>
                        <h3 class="label">Emotions: </h3>
                        <h2 class="emotionDisplay">#Neutral</h2>
                      </div>
                      <button class="editBtn editBasic" type="button"><img src="../../pic/icon/edit.svg" alt="edit-emotion"></button>
                    </div>
                    <div class="question editQuestion flex justifyBetween alignBottom">
                      <div class="questionContainer">
                        <h3 class="label">Question: </h3>
                        <h2 class="questionDisplay">What’s in your mind today?</h2>
                      </div>
                      <button class="editBtn" type="button"><img src="../../pic/icon/edit.svg" alt="edit-question"></button>
                    </div>
                  </div>
                  <form class="textAreaForm flex justifyCenter" action="" method="post">
                    <textarea name="ansText" rows="13" placeholder="Tap to edit"></textarea>
                  </form>`;
}

const appendNextBtn = () => {
  return `<div class="left">
                  <button class="flex justifyEnd alignCenter prevBtn" type="button"><img src="../../pic/icon/arrow.svg" alt="previous-entry"><h5>Before</h5></button>
                </div>
                <div class="right flex flexColumn">
                  <button class="flex justifyBetween alignCenter addQuestion" type="button"><h5>Add Question</h5><img src="../../pic/icon/plus.svg" alt="add-question"></button>
                  <button class="flex justifyBetween alignCenter nextQuestion" type="button"><h5>Next</h5><img src="../../pic/icon/arrow.svg" alt="next-entry"></button>
                </div>
              </div>
            </div>`;
}

const appendSaveBtn = () => {
  return `<div class="left">
              <button id="saveBtn" class="flex justifyEnd alignCenter prevBtn" type="button"><img src="../../pic/icon/arrow.svg" alt="previous-entry"><h5>Before</h5></button>
          </div>
          <div class="right flex flexColumn">
              <button class="flex justifyBetween alignCenter addQuestion" type="button"><h5>Add Question</h5><img src="../../pic/icon/plus.svg" alt="add-question"></button>
              <button class="flex justifyBetween alignCenter saveBtn" type="button"><h5>Save</h5><img src="../../pic/icon/ok.svg" alt="save-and-exit"></button>
          </div>
              </div>`;
}


const insertXhr = (journalId, title, emotion, questionArr, ansArr) => {
  let questionStr = JSON.stringify(questionArr);
  let ansStr = JSON.stringify(ansArr);
  let paramStr = `param=${JSON.stringify([journalId, title, emotion, questionStr, ansStr])}`;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../php/journal/insertJournal.php" ,true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    const allQuestionSlides  = document.querySelectorAll('.questionSlide');
    if (this.status == 200) {
      let res = JSON.parse(this.responseText);
      if (res.success == "true"){
        location.href = "./journal.php?insert=success";
      } else if ('send' in res && res.send == 'success'){
        location.href = "./journal.php?insert=success";
      } else if ('ans' in res && res.ans.length > 0){
        let allAnsId = res.ans;
        let targetId = res.ans[0];
        const allTextArea = document.querySelectorAll('.questionSlide textarea[name=ansText]');
        for (let i = targetId + 1; i < allQuestionSlides.length; i++) {
          allQuestionSlides[i].style.left = "150%";
        }
        allAnsId.forEach(id => allTextArea[id].style.border = '5px solid #FF6565');
        exitFloat();
        popupIn();

      } else if ( ('title' in res && res.title.length > 0) || ('emotion' in res && res.emotion.length > 0) ) {
        const emotionSlide = document.querySelector('#emotionSlide');
        allQuestionSlides.forEach(slide => slide.style.left = '150%');
        emotionSlide.style.left = '0';
        exitFloat();
        popupIn();
      } else if( 'error' in res && res.error == 'timelimit' ){
        location.href = "./journal.php?insert=timelimit";
      } else {
        location.href = "./journal.php?insert=error";
      }
    } else if (this.status == 404){
      location.href = "./journal.php?insert=error";
    }
  }
  xhr.send(paramStr);
}

const addQuestion = () => {
  let addQuestionBtns = document.querySelectorAll('.addQuestion');
  const bottomBtns = document.querySelectorAll('.bottomBtns');

  addQuestionBtns.forEach(btn => btn.addEventListener('click', () => {
    let targetBottom = bottomBtns[bottomBtns.length - 1];
    let newDiv = document.createElement("div");
    newDiv.setAttribute("class", "bottomBtns flex alignBottom justifyBetween");
    newDiv.innerHTML = appendNextBtn();
    targetBottom.parentNode.replaceChild(newDiv, targetBottom);
    const questionWrapper = document.querySelector('.question-wrapper');
    let newTemplate = document.createElement("div");
    newTemplate.setAttribute("class", "slide questionSlide");
    newTemplate.innerHTML = getTemplate();
    questionWrapper.appendChild(newTemplate);

    const allQuestionSlides  = document.querySelectorAll('.questionSlide');
    const targetSlide = allQuestionSlides[allQuestionSlides.length - 1];
    let newSave = document.createElement("div");
    newSave.setAttribute("class", "bottomBtns flex alignBottom justifyBetween");
    newSave.innerHTML = appendSaveBtn();
    targetSlide.appendChild(newSave);
    addQuestionBtns = document.querySelectorAll('.addQuestion');
    addQuestionBtns.forEach(btn => btn.classList.add('inactive'));
    allQuestionSlides.forEach(slide => slide.style.left = "0");

    let thisTitle = allQuestionSlides[0].querySelector('.journalTitle').innerText.trim();
    targetSlide.querySelector('.journalTitle').innerText = getTitleInput();
    let thisEmotion = allQuestionSlides[0].querySelector('.emotionDisplay').innerText.substring(1).toLowerCase();
    targetSlide.querySelector('.emotionDisplay').innerText = `#${thisEmotion[0].toUpperCase() + thisEmotion.substring(1).trim()}`;
    targetSlide.querySelector('.saveBtn').classList.add('inactive');

    const titleInput = document.querySelector('.editTitle');
    titleInput.value = thisTitle;

    const allEmotionDesc = document.querySelectorAll(".emotionPanel .selector h3");
    const allIndicators = document.querySelectorAll(".emotionPanel .selector img");
    const emotionRadios = document.querySelectorAll("#emotionForm input");
    allEmotionDesc.forEach((emotion, i) => {
      if (emotion.innerText.trim().toLowerCase() == thisEmotion.trim().toLowerCase()) {
        emotionRadios[i].checked = true;
        allIndicators.forEach(indicator => indicator.classList.remove('onSelected'));
        allIndicators[i].classList.add('onSelected');
      }
    })

    addQuestion();
    functionConn();
  }));

}

const popupIn = () => {
  const popup = document.querySelector(".popup");
  const h2 = popup.querySelector('.popup h2');
  h2.innerText = 'Missing fields:';
  const h3 = popup.querySelector('.popup h3');
  h3.innerText = 'Please answer all the questions.';
  popup.style.bottom = "0";
  popupClose(popup);
}

const popupClose = (popup) => {
  const popupCloseBtn = document.querySelector(".popup .closeBtn");
  popupCloseBtn.addEventListener('click', () => popup.style.bottom = "-100%");
}

const exitFloat = () => {
  const floatWin = document.querySelector('.floatWin');
  const darkenBg = document.querySelector('.darkenBg');

  floatWin.style.opacity = '0';
  floatWin.style.pointerEvents = 'none';
  darkenBg.style.display = 'none';
}

const nextSlide = () => {
  const nextBtns = document.querySelectorAll('.nextQuestion');

  nextBtns.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      const questionSlides = document.querySelectorAll('.questionSlide');
      if (questionSlides[i+1] != null) {
        questionSlides[i+1].style.left = '0';
      }
    })
  });
}

const prevSlide = () => {
  const prevBtns = document.querySelectorAll('.prevBtn');
  const emotionSlide = document.querySelector('#emotionSlide');

  prevBtns.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      const questionSlides = document.querySelectorAll('.questionSlide');
      if (questionSlides[i-1] == null) {
        emotionSlide.style.left = '0';
      }
      questionSlides[i].style.left = '150%';
    })
  });
}

const moveToBasic = () => {
  const editBasicBtns = document.querySelectorAll('.editBasic');
  const emotionSlide = document.querySelector('#emotionSlide');
  const questionSlides = document.querySelectorAll('.questionSlide');

  editBasicBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      questionSlides.forEach(slide => slide.style.left = "150%");
      emotionSlide.style.left = '0';
    })
  });
}

// global var
  let isEmotionSelected = true;
let hasTitle = true;

// when a selector is clicked, select the input based on index
// assign that input value to the "emotion" variable
// if "emotion" variable has value, make the 'next' button visble and clickable
const chooseEmotion = () => {
  const allEmotion = document.querySelectorAll(".emotionPanel .selector");
  const allIndicators = document.querySelectorAll(".emotionPanel .selector img");
  const emotionRadios = document.querySelectorAll("#emotionForm input");
  let emotion = '';

  allEmotion.forEach((selector, i) => {
    selector.addEventListener('click', () => {
      emotionRadios[i].checked = true;
      allIndicators.forEach(indicator => indicator.classList.remove('onSelected'));
      allIndicators[i].classList.add('onSelected');
      emotion = emotionRadios[i].value;
      isEmotionSelected = true;
      enableSaveEmotion();
      // if (emotion.length <= 0) {
      //   isEmotionSelected = false;
      // }
    })
  });
}

// save emotion data
const saveBasic = () => {
  const allEmotionDisplay = document.querySelectorAll('.emotionDisplay');
  const basicSaveBtn = document.querySelector('#emotionSlide #emotionSub');
  basicSaveBtn.addEventListener('click', () => {
    let emotion = getEmotion();
    let title = getTitleInput();
    allEmotionDisplay.forEach(display => display.innerText = `#${emotion[0].toUpperCase()}${emotion.substring(1).toLowerCase()}`);

    const allJournalTitle = document.querySelectorAll('.journalTitle');
    allJournalTitle.forEach(text => text.innerText = title);
    showQuestionPanel(0);
  })
}

const getTitleInput = () => {
  const titleInput = document.querySelector('.editTitle');
  return titleInput != null ? titleInput.value.trim() : '';
}

const showQuestionPanel = (i) => {
  const emotionSlide = document.querySelector('#emotionSlide');
  const questionSlides = document.querySelectorAll('.questionSlide');
  emotionSlide.style.left = '-150%';
  questionSlides[i].style.left = '0';
}

const getEmotion = () => {
  let emotion = '';
  const emotionRadios = document.querySelectorAll("#emotionForm input");
  emotionRadios.forEach(input => {
    if (input.checked == true) {
      emotion = input.value.trim().toLowerCase();
    }
  });
  return emotion;
}

const validateTitle = () => {
  const titleInput = document.querySelector('.editTitle');
  if (titleInput != null) {
    titleInput.addEventListener('input', () => {
      (titleInput.value.length <= 0) ? hasTitle = false : hasTitle = true;
      enableSaveEmotion();
    })
  }
}

const enableSaveEmotion = () => {
  const basicSaveBtn = document.querySelector('#emotionSlide #emotionSub');

  if (isEmotionSelected && hasTitle) {
    basicSaveBtn.classList.remove('inactive');
  } else{
    basicSaveBtn.classList.add('inactive');
  }
}

// Question slide
const moveQuestionModal = () => {
  let index = -1;
  const selectorWrapper = document.querySelector('.selectorWrapper');
  const editQuestionBtns = document.querySelectorAll('.editQuestion');
  const questionContainers = document.querySelectorAll('.questionContainer');
  const allQuestionDisplay = document.querySelectorAll('.questionDisplay');
  const allTextArea = document.querySelectorAll('.questionSlide textarea[name=ansText]');
  const options = document.querySelectorAll('.selectorWrapper .option');
  const nextBtns = document.querySelectorAll('.nextQuestion');

  editQuestionBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      index = Array.from(questionContainers).indexOf(e.target.parentElement);
      options.forEach(option => {
        option.addEventListener('click', () => {
          selectorWrapper.style.left = "-150%";
          allQuestionDisplay[index].innerText = option.innerText.trim();
        })
      });

      selectorWrapper.style.left = "0";
    });
  });
  const quitBtn = document.querySelector('#quitBtn');
  quitBtn.addEventListener('click', () => selectorWrapper.style.left = "-150%");
}

const validateTextArea = () => {
  const allTextArea = document.querySelectorAll('.questionSlide textarea[name=ansText]');
  const nextBtns = document.querySelectorAll('.nextQuestion');
  const saveBtn = document.querySelector('.saveBtn');
  const addQuestionBtns = document.querySelectorAll('.addQuestion');

  allTextArea.forEach((area, i) => {
    area.addEventListener('input', () => {
      area.value.length <= 0 ? addQuestionBtns.forEach(btn => btn.classList.add('inactive')) : addQuestionBtns.forEach(btn => btn.classList.remove('inactive'));
      if (nextBtns[i] != null) {
        area.value.length <= 0 ? nextBtns[i].classList.add('inactive') : nextBtns[i].classList.remove('inactive');
        area.value.length <= 0 ? saveBtn.classList.add('inactive') : saveBtn.classList.remove('inactive');
      } else{
        area.value.length <= 0 ? saveBtn.classList.add('inactive') : saveBtn.classList.remove('inactive');
      }
    })
  });
}

const saveData = () => {
  const saveBtn = document.querySelector('.saveBtn');
  const floatSaveBtn = document.querySelector('#saveBtn');
  saveBtn.addEventListener('click', getUserInput);
  floatSaveBtn.addEventListener('click', getUserInput);
}

const getUserInput = () => {
  const titleInput = document.querySelector('.editTitle');
  const emotionRadios = document.querySelectorAll("#emotionForm input");
  const allQuestionDisplay = document.querySelectorAll('.questionDisplay');
  const allTextArea = document.querySelectorAll('.questionSlide textarea[name=ansText]');

  let title = "";
  let emotion = "";
  let questionArr = [];
  let ansArr = [];
  let journalId = getJournalId();

  title = titleInput.value.trim();
  emotionRadios.forEach(radio => {
    if (radio.checked == true) {
      emotion = radio.value.trim().toLowerCase();
    }
  });
  allQuestionDisplay.forEach(question => questionArr.push(question.innerText.trim().toLowerCase()));
  allTextArea.forEach(area => ansArr.push(area.value.trim()));

  insertXhr(journalId, title, emotion, questionArr, ansArr);

  //reset arrays
  questionArr = [];
  ansArr = [];
}


const setDefaultEmotion = () => {
  const neutralRadio = document.querySelector('#neutralRadio');
  const neutralEmotion = document.querySelector('#neutralEmotion img');

  neutralRadio.checked = true;
  neutralEmotion.classList.add('onSelected');
}

const functionConn = () =>{
  prevSlide();
  nextSlide();
  moveToBasic();

  chooseEmotion();
  validateTitle();
  saveBasic();

  moveQuestionModal();
  validateTextArea();
  saveData();

  addQuestion();
}

functionConn();
setDefaultEmotion();
