/* eslint-disable */
const element = document.querySelector('.contact-form')
const nickname = document.querySelector('input[name=nickname]')
const email = document.querySelector('input[name=email]')
const phone = document.querySelector('input[name=phone]')
const program = document.getElementsByName('program')
const labelForground = document.querySelector('label[for=ground]')
const infoSource = document.querySelector('input[name=info-source]')
const otherSuggetion = document.querySelector('input[name=other-suggestion]')

element.addEventListener('submit', function (event) {
  if (// 填寫完成必填項目
    (nickname.value !== '') &&
    (email.value !== '') &&
    (phone.value !== '') &&
    ((program[0].checked !== false) || (program[1].checked !== false)) &&
    (infoSource.value !== '')
  ) {
    if (program[0].checked === true) {
      alert(`
      暱稱：${nickname.value}
      email：${email.value}
      手機號碼：${phone.value}
      報名類型：躺在床上用力想像實作
      活動資訊來源：${infoSource.value}
      其他建議：${otherSuggetion.value}
    `)
    } else {
      alert(`
      暱稱：${nickname.value}
      email：${email.value}
      手機號碼：${phone.value}
      報名類型：趴在地上划手機找現成的
      活動資訊來源：${infoSource.value}
      其他建議：${otherSuggetion.value}
    `)
    }
  } else { // 沒有填寫完成必填項目
    if (nickname.value === '') {
      nickname.nextSibling.innerHTML = '請填寫暱稱'
      nickname.nextSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      nickname.nextSibling.innerHTML = ''
      nickname.nextSibling.classList.remove('submit-reminding')
    }

    if (email.value === '') {
      email.nextSibling.innerHTML = '請填寫 email'
      email.nextSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      email.nextSibling.innerHTML = ''
      email.nextSibling.classList.remove('submit-reminding')
    }

    if (phone.value === '') {
      phone.nextSibling.innerHTML = '請填寫手機號碼'
      phone.nextSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      phone.nextSibling.innerHTML = ''
      phone.nextSibling.classList.remove('submit-reminding')
    }

    if ((program[0].checked === false) && (program[1].checked === false)) {
      labelForground.nextSibling.innerHTML = '請選擇一項'
      labelForground.nextSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      labelForground.nextSibling.innerHTML = ''
      labelForground.nextSibling.classList.remove('submit-reminding')
    }

    if (infoSource.value === '') {
      infoSource.nextSibling.innerHTML = '請填寫該欄位'
      infoSource.nextSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      infoSource.nextSibling.innerHTML = ''
      infoSource.nextSibling.classList.remove('submit-reminding')
    }
  }
})