/* eslint-disable */
const request = require('request')
const process = require('process')

const httpMethod = process.argv[2]
const arg = process.argv[3]
const bookNameUpdate = process.argv[4]
const BASE_URL = 'https://lidemy-book-store.herokuapp.com/books'
const originBookArray = [
  {
    name: 'arrayIndex',
  },
  {
    name: '克雷的橋',
  },
  {
    name: '當我想你的時候全世界都救不了我',
  },
  {
    name: '我殺的人與殺我的人',
  },
  {
    name: '念念時光真味',
  },
  {
    name: '我殺的人與殺我的人',
  },
  {
    name: '苦雨之地',
  },
  {
    name: '你已走遠，我還在練習道別',
  },
  {
    name: '想把餘生的溫柔都給你',
  },
  {
    name: '你是我最熟悉的陌生人',
  },
  {
    name: '偷書賊（25萬本紀念版本）',
  },
  {
    name: '在回憶消逝之前',
  },
  {
    name: '懲罰',
  },
  {
    name: '雲邊有個小賣部',
  },
  {
    name: '颶光典籍三部曲：引誓之劍（上下冊套書）',
  },
  {
    name: '危險維納斯',
  },
  {
    name: '大旱',
  },
  {
    name: '最後的再見',
  },
  {
    name: '解憂雜貨店【暢銷35萬冊暖心紀念版】：回饋讀者，一次收藏2款書封！',
  },
  {
    name: '高山上的小郵局：獻給書信和手寫年代的溫暖情詩，2019年最治癒人心的高暖度小說',
  },
  {
    name: '在場證明',
  },
]

switch (httpMethod) {
  case 'list':
    request(BASE_URL, (error, response, body) => console.log(body))
    break
  case 'read':
    request(BASE_URL, (error, response, body) => {
      const BODY = JSON.parse(body)
      console.log(`id: ${BODY[arg - 1].id}`, `name: ${BODY[arg].name}`)
    })
    break
  case 'delete':
    request.delete(`${BASE_URL} / ${arg}`)
    break
  case 'create':
    request.post(
      {
        url: BASE_URL,
        form: {
          name: `${arg}`,
        },
      },
      (error, response, body) => console.log(body),
    )
    break
  case 'update': // 修改原有
    request.patch(
      {
        url: `${BASE_URL} / ${arg}`,
        form: {
          name: `${bookNameUpdate}`,
        },
      },
      (error, response, body) => console.log(body),
    )
    break
  case 'originData': // 將 id 1 ~ 20 的資料復原。
    for (let i = 1; i < 21; i + 1) {
      request.patch(
        {
          url: `${BASE_URL} / ${i}`,
          form: {
            name: originBookArray[i].name,
          },
        },
        (error, response, body) => console.log(body),
      )
    }
    break
  default:
    console.log('Wrong httpMethod')
}
