/* eslint-disable */
const addInput = document.querySelector('.add__input')
const wait = document.querySelector('.wait')

function addWaitItem(content) {
  const waitItem = document.createElement('div')

  wait.appendChild(waitItem).innerHTML = `
    <div class="wait__item">
      <input type="checkbox" class="wait__item__checkbox" />
      <input type="text" class="wait__item__text" value="${content}"/>
      <i class="fas fa-times"></i>
    </div>
  `
}

addInput.addEventListener('keydown', (event) => {
  if (event.keyCode === 13) {
    const content = addInput.value.trim()
    if (content == '') {
      alert('Please add something ლ(・´ｪ`・ლ)!')
    } else {
      addWaitItem(content)
      addInput.value = ''
    }
  }
})

wait.addEventListener('click', (event) => {
  if (event.target.classList.contains('fa-times')) {
    event.target.parentNode.remove()
  }

  if (event.target.classList.contains('wait__item__checkbox')) {
    event.target.parentNode.children[1].classList.toggle('line-through')
  }
})

wait.addEventListener('keypress', (event) => {
  if (event.target.classList.contains('wait__item__text')) {
    if (event.keyCode === 13) {
      event.target.blur()
    }
  }
})
