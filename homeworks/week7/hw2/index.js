/* eslint-disable */
const question = document.querySelectorAll('.question')
const answerDisplay = document.querySelectorAll('.answer__display__none')

for (let i=0; i<question.length; i++) {
  question[i].addEventListener('click', () => {
    answerDisplay[i].classList.toggle('answer__display__none')
  })
}
