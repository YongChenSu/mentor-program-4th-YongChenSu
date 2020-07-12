/* eslint-disable */
const request = require('request')

const BASE_URL = 'https://api.twitch.tv/kraken'

request({
  method: 'GET',
  url: `${BASE_URL}/games/top`,
  headers: {
    'Client-ID': '2lqv2fjirubv1wtnirr9a9l68kvub0',
    'Accept': 'application/vnd.twitchtv.v5+json',
  },
}, (error, response, body) => {
  const data = JSON.parse(body)
  for (let i = 0; i < data.top.length; i + 1) {
    console.log(`${data.top[i].viewers} ${data.top[i].game.localized_name}`)
  }
})
