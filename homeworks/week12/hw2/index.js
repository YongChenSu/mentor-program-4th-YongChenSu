/* eslint-disable */
const addInput = document.querySelector('.add__input')
const todoList = document.querySelector('.todo__list')

jQuery.fn.tagNameLowerCase = function() {
  return this.prop("tagName").toLowerCase();
}

function escape(toOutput){
  return toOutput.replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F')
}

function addTodoItem(content) {
  const todoItem = document.createElement('div')

  todoList.appendChild(todoItem).innerHTML = `
    <div class="todo__item">
      <input type="checkbox" class="item__checkbox" />
      <input type="text" class="item__text" value="${escape(content)}"/>
      <i class="fas fa-times"></i>
    </div>
  `
}

function itemsLeft() {
  let completedItems = 0
  let totalItems = $('.todo__item').length
  
  for (let todos of $('.todo__item')) {
    if (todos.children[1].classList.contains('line-through')) {
      completedItems += 1
    }
  }
  $('.todo__num').text(totalItems - completedItems+ ' items left')
}

function clearCompletedItems() {
  for (let todos of $('.todo__item')) {
    if (todos.children[1].classList.contains('line-through')) {
      todos.remove()
    }
  }
}

$('.add__input').keyup(event => {
  if (event.keyCode === 13) {
    const content = addInput.value.trim()
    escape(content)
    if (content == '') {  
      alert('Please add something ლ(・´ｪ`・ლ)!')
    } else {
      addTodoItem(content)
      addInput.value = ''
    }
    itemsLeft()
  }
})

$('.todo__list').delegate('.todo__item', 'click', event => {
  if ($(event.target).hasClass('fa-times')) {
    $(event.target).parent().remove()
  }

  if ($(event.target).hasClass('item__checkbox')) {
    $(event.target).parent().toggleClass('active')
    $(event.target).parent().toggleClass('completed')
    $(event.target).next().toggleClass('line-through')
  }
  itemsLeft()
})

$('.todo__list').delegate('.todo__item', 'keydown', event => {
  if ($(event.target).hasClass('item__text')) {
    if (event.keyCode === 13) {
      event.target.blur()
    }
  }
})

$('.footer').click( event => {
  if ($(event.target).tagNameLowerCase() === 'li') {
    let statusArray = $(event.target).parent().children()
    for (let status of statusArray) {
      status.classList.remove('selected')
    }
    $(event.target).toggleClass('selected')
  }

  if ($(event.target).hasClass('all')) {
    for (let todos of $('.todo__item')) {
      todos.classList.remove('hide')
    }
  }

  if ($(event.target).hasClass('active')) {
    $('.todo__item').map((index, item) => {
      item.classList.contains('completed') ? 
      item.classList.add('hide') : item.classList.remove('hide')
    })
  }

  if ($(event.target).hasClass('completed')) {
    $('.todo__item').map((index, item) => {
      item.classList.contains('active') ? 
      item.classList.remove('hide') : item.classList.add('hide')
    })
  }
})

$('.clear').click(e => {
  e.preventDefault()
  clearCompletedItems()
})