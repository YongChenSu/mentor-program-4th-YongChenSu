/* eslint-disable */
const twitch = {
  API_URL: 'https://api.twitch.tv/kraken',
  clientId: '2lqv2fjirubv1wtnirr9a9l68kvub0',
  streams: document.querySelector('.streams'),
  main: document.querySelector('.main'),
  div: document.createElement('div'),
  topGames: document.querySelector('.top__games'),
  topGameNum: 5,
  streamNum: 20,
  topGameOffset: 0,
}
const { API_URL, clientId, streams, main, div, topGames } = twitch
let { topGameNum, streamNum, topGameOffset } = twitch

const sendRequest = (sendRequestUrl, callback) => {
  const request = new XMLHttpRequest()

  request.open('GET', sendRequestUrl, true)
  request.setRequestHeader('Client-ID', clientId)
  request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json')
  request.onerror = () => console.log('error')
  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      let json
      try {
        json = JSON.parse(request.response)
      } catch (error) {
        console.log(error)
        return
      }
      callback(json)
    }
  }
  request.send()
}

getTopGames = (gameData) => {
  const { name } = gameData.top[0].game
  console.log(name)
  const topGameTemplate = gameData.top.map(topGame => `
    <div class="top__game__container">
      <img class="top__game__preview" src="${topGame.game.box.large}" alt="">
      <div class="top__game__name">${topGame.game.name}</div>
    </div>
  `).join('')

  topGames.innerHTML = topGameTemplate
  sendRequest(`https://api.twitch.tv/kraken/streams/?game=${name}&limit=${streamNum}`, getStreams)
}

getStreams = (streamData) => {
  div.innerHTML = `
    <button class="load">MORE</button>
  `
  const streamTemplate = streamData.streams.map(item => `
    <div class="stream__container">
      <div class="stream">
        <a href="${item.channel.url} target="_blank">
          <img class='stream__preview' src="${item.preview.large}" alt="">
        </a>
        <div class="stream__info">
          <img class="stream__logo" src="${item.channel.logo}" alt="">
          <div>
            <div class="stream__name">${item.channel.name}</div>
            <div class="stream__status">${item.channel.status}</div>
          </div>
        </div>
      </div>
    </div>
  `).join('')

  streams.innerHTML = streamTemplate
  main.appendChild(div)
}

topGames.addEventListener('click', (event) => {
  streamNum = 20
  if (event.target.parentNode.children[1].classList.contains('top__game__name')) {
    gameName = event.target.parentNode.innerText
    sendRequest(`https://api.twitch.tv/kraken/streams/?game=${gameName}&limit=${streamNum}`, getStreams)
  }
})

main.addEventListener('click', (event) => {
  if (event.target.classList.contains('load')) {
    streamNum += 20
    sendRequest(`https://api.twitch.tv/kraken/streams/?game=${gameName}&limit=${streamNum}`, getStreams)
  }
})

sendRequest(`${API_URL}/games/top?limit=${topGameNum}&offset=${topGameOffset}`, getTopGames)
