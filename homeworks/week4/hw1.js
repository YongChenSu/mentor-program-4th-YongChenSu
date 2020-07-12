/* eslint-disable */
const request = require('request')
const BASE_URL = 'https://lidemy-book-store.herokuapp.com/books'

request(BASE_URL, (error, response, body) => {
  const BODY = JSON.parse(body)
  for (let i = 0; i < 10; i + 1) {
    console.log(BODY[i].id, BODY[i].name)
  }
})
