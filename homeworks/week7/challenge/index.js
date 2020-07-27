/* eslint-disable */
const slide = document.querySelector('#slide')
const items = document.querySelectorAll('img.picture')
const itemCount = items.length
const timer = 3000
const showPrevBtn = document.querySelector('.fa-angle-left')
const showNextBtn = document.querySelector('.fa-angle-right')

let counter = 0

const showCurrent = () => {
  const itemToShow = Math.abs(counter % itemCount)
  items.forEach(item => item.classList.remove('show'))
  items[itemToShow].classList.add('show')
}

const showPre = () => {
  counter--
  showCurrent()
}

const showNext = () => {
  counter++
  showCurrent()
}

let carousel = window.setInterval(showNext, timer)

showPrevBtn.addEventListener('click', showPre, false)
showNextBtn.addEventListener('click', showNext, false)

slide.addEventListener('mouseover', () => {
  carousel = clearInterval(carousel)
})

slide.addEventListener('mouseout', () => {
  carousel = window.setInterval(showNext, timer)
})

showCurrent()
