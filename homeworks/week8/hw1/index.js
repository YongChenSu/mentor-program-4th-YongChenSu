/* eslint-disable */
const lotto = document.querySelector('.lotto')
const request = new XMLHttpRequest()
const div = document.createElement('div')

let prizeText = ''
const lottoResult = (PRIZE) => {
  const prize = PRIZE.toLowerCase()
  const prizeClass = 'lotto__' + prize

  lotto.innerHTML = ''
  div.innerHTML = `
    <div class="${prizeClass}">
      <div class="prize__content">
        <h1>${prizeText}</h1>
        <button class="lotto__button">我要抽獎</button>
        <button class="method__button">抽獎詳情</button>
      </div>
    </div>
  `
  lotto.appendChild(div)
}

lotto.addEventListener('click', (event) => {
  if (event.target.classList.contains('lotto__button')) {
    request.onload = () => {
      if (request.status >= 200 && request.status < 400) {
        const data = JSON.parse(request.responseText)
        const PRIZE = data.prize

        switch (PRIZE) {
          case 'FIRST':
            prizeText = '恭喜你中頭獎了！日本東京來回雙人遊！'
            lottoResult(PRIZE)
            break
          case 'SECOND':
            prizeText = '恭喜你抽中二獎！90 吋電視一台！'
            lottoResult(PRIZE)
            break
          case 'THIRD':
            prizeText = '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！'
            lottoResult(PRIZE)
            break
          case 'NONE':
            prizeText = '銘謝惠顧'
            lottoResult(PRIZE)
            break
          default:
            alert('系統不穩定，請再試一次')
        }
      } else {
        alert('系統不穩定，請再試一次')
      }
    }

    request.onerror = () => {
      alert('系統不穩定，請再試一次')
    }

    request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true)
    request.send()
  } else if (event.target.classList.contains('method__button')) {
    lotto.innerHTML = ''
    div.innerHTML = `
      <div class="lotto__method">
      <div class="lotto__card">
        <div class="lotto__card__title">
          2020 夏日輕盈特賞！ 抽獎活動辦法
        </div>
  
        <div class="lotto__card__contents">
          <div class="lotto__card__content">
            <h3>活動期間：</h3>
            <p>2020/08/01 ~ 2020/09/30</p>
          </div>
          <div class="lotto__card__content">
            <h3>活動期間：</h3>
            <p>今天老闆佛心來著決定給大家發獎勵，有看有機會，沒看只能幫QQ！只要在店內消費滿1000000元即有機會獲得 - 頭獎日本東京來回雙人遊！</p>
          </div>
          <div class="lotto__card__content">
            <h3>活動期間：</h3>
            <p>
              ❤ 頭獎一名：日本東京來回雙人遊(市價14990元)<br>
              ❤ 貳獎三名：90 吋電視一台(市價5990元)<br>
              ❤ 參獎十名：知名 YouTuber 簽名握手會入場券一張(市價1500元)
            </p>
          </div>
        </div>
        
        <button class="lotto__button">我要抽獎</button>
      </div>
      </div>
    `
    lotto.appendChild(div)
  }
})
