/* eslint-disable */
const request = require('request')
const process = require('process')

const httpMethod = process.argv[2]
const arg = process.argv[3]
const bookNameUpdate = process.argv[4]
const BASE_URL = 'https://lidemy-book-store.herokuapp.com/books'

switch (httpMethod) {
  case 'list':
    request(`${BASE_URL}?_limit=20`, (error, response, body) => {
      let data = ''
      try {
        data = JSON.parse(body)
      } catch (err) {
        console.log(err)
      }
      for (let i = 0; i < data.length; i += 1) {
        console.log(`${data[i].id} ${data[i].name}`)
      }
    })
    break
  case 'read':
    request(`${BASE_URL}/${arg}`, (error, response, body) => {
      let data = ''
      try {
        data = JSON.parse(body)
      } catch (err) {
        console.log(err)
      }
      console.log(`${data.id} ${data.name}`)
    })
    break
  case 'delete':
    request.delete(`${BASE_URL}/${arg}`)
    break
  case 'create':
    request.post(
      {
        url: BASE_URL,
        form: {
          name: `${arg}`,
        },
      },
      (error, response, body) => {
        let data = ''
        try {
          data = JSON.parse(body)
        } catch (err) {
          console.log(err)
        }
        console.log(data)
      },
    )
    break
  case 'update': // 修改原有
    request.patch(
      {
        url: `${BASE_URL}/${arg}`,
        form: {
          name: `${bookNameUpdate}`,
        },
      },
      (error, response, body) => {
        let data = ''
        try {
          data = JSON.parse(body)
        } catch (err) {
          console.log(err)
        }
        console.log(data)
      },
    )
    break
  default:
    console.log('Wrong httpMethod')
}
