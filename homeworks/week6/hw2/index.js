/* eslint-disable */
const element = document.querySelector('.contact-form')
const nickname = document.querySelector('input[name=nickname]')
const email = document.querySelector('input[name=email]')
const phone = document.querySelector('input[name=phone]')
const program = document.getElementsByName('program')
const labelForground = document.querySelector('label[for=ground]')
const infoSource = document.querySelector('input[name=info-source]')
const otherSuggetion = document.querySelector('input[name=other-suggestion]')

element.addEventListener('submit', (event) => {
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
      nickname.nextElementSibling.innerHTML = '請填寫暱稱'
      nickname.nextElementSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      nickname.nextElementSibling.innerHTML = ''
      nickname.nextElementSibling.classList.remove('submit-reminding')
    }

    if (email.value === '') {
      email.nextElementSibling.innerHTML = '請填寫 email'
      email.nextElementSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      email.nextElementSibling.innerHTML = ''
      email.nextElementSibling.classList.remove('submit-reminding')
    }

    if (phone.value === '') {
      phone.nextElementSibling.innerHTML = '請填寫手機號碼'
      phone.nextElementSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      phone.nextElementSibling.innerHTML = ''
      phone.nextElementSibling.classList.remove('submit-reminding')
    }

    if ((program[0].checked === false) && (program[1].checked === false)) {
      labelForground.nextElementSibling.innerHTML = '請選擇一項'
      labelForground.nextElementSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      labelForground.nextElementSibling.innerHTML = ''
      labelForground.nextElementSibling.classList.remove('submit-reminding')
    }

    if (infoSource.value === '') {
      infoSource.nextElementSibling.innerHTML = '請填寫該欄位'
      infoSource.nextElementSibling.classList.add('submit-reminding')
      event.preventDefault()
    } else {
      infoSource.nextElementSibling.innerHTML = ''
      infoSource.nextElementSibling.classList.remove('submit-reminding')
    }
  }
})