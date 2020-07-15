/* eslint-disable */
const request = require('request')
const process = require('process')

const API_ENDPOINT = 'https://restcountries.eu/rest/v2/name'
const countryName = process.argv[2]

if (!countryName) {
  console.log('請輸入國家名稱');
}

request(
  `${API_ENDPOINT}/${countryName}`,
  (error, response, body) => {
    if (error) {
      return console.log('Failure', error)
    }

    const data = JSON.parse(body)

    if (data.status >= 400 && data.status < 600) {
      return console.log('找不到國家資訊')
    }

    for (let i = 0; i < data.length; i++) {
      console.log('============')
      console.log('國家:' + data[i].name)
      console.log('首都:' + data[i].capital)
      console.log('貨幣:' + data[i].currencies[0].code)
      console.log('國碼:' + data[i].callingCodes[0])
    }
  }
)
