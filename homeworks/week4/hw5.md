## 請以自己的話解釋 API 是什麼
API (Application Programing Interface)，應用程式<span class="red">**介面**<span>。

當別人想要跟你要東西時，因不會直接把資料庫的權限給對方，是根據 API (**介面**) 讓對方可存取資料，也可限制對方資料的存取權限。而當自己想跟對方要資料時也是透過 API。故**透過 API 可讓雙方交換資料**。


## 請找出三個課程沒教的 HTTP status code 並簡單介紹
#### 1. 201 created
通常 POST 或 PUT 之後會回傳 status code: 201，代表**請求成功後且建立新的資源**。

#### 2. 403 forbidden
用戶端並無訪問權限，例如未被授權，所以伺服器拒絕給予應有的回應。不同於 401，伺服端知道用戶端的身份。

#### 3. 505 HTTP Version Not Supported
請求的 HTTP 版本不被伺服器支援。


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。
- ### BASE_URL：
```javascript=
https://lidemy-restaurant.herokuapp.com
```

- ### Require authentication：
	false

- ### Parameters：
	:id

- ### Response：
|說明         |	Method |	path             |	   參數                |	範例                |
|---         | ---    | ---               | ---                    | ---                 |
|獲取所有餐廳  |	GET    |	/restaurant     |	_limit:限制回傳資料數量   |	/restaurant?_limit=5    |
|獲取單一餐廳  |	GET	   | /restaurant/:id  |	無                      |  /restaurant/10          |
|新增餐廳     | POST   | /restaurant       |	name: 餐廳名             |	 無                  |
|刪除餐通     | DELETE | /restaurant/:id   |	無                      |	無                  |
|更改餐廳資訊  |	PATCH  |	/restaurant/:id |	name: 餐廳名             |	無                 |

- ### Error code：
	205: Invalid parameters
	
- ### Example Request:
```javascript=
const request = require('request')
const BASE_URL = 'https://lidemy-restaurant.herokuapp.com'

request({
    method: 'GET',
    url: `${BASE_URL}/restaurant/`,
  },

  (error, response, body) => {
    const data = JSON.parse(body)
    console.log(data)
  }
)
```

- ### Example Response
```javascript=
[
  {
    name: "999'S KITCHEN",
    category: 'Snack',
    foodType: 'Restauration rapide',
    phone: '+687 90.33.33',
    address: '11 RUE ANATOLE FRANCECENTRE VILLE, Centre ville, NOUMEA, Nouvelle-Calédonie',
    city: 'NOUMEA',
    district: 'Centre ville',
    googleMapsUrl: null
  },
  {
    name: 'A LA VIEILLE FRANCE',
    category: 'Boulangerie et boulangerie-pâtisserie',
    foodType: null,
    phone: '+687 27.50.41',
    address: '77 RUE DE SEBASTOPOLQUARTIER LATIN, Quartier latin, NOUMEA, Nouvelle-Calédonie',
    city: 'NOUMEA',
    district: 'Quartier latin',
    googleMapsUrl: 'https://goo.gl/maps/ohTHpEiZCR42'
  },
  {
    name: 'ALIMENTATION CHEZ JASMINE',
    category: 'Alimentation',
    foodType: null,
    phone: '+687 46.28.91',
    address: '24 rue Emile Zola, Mt-Dore, MONT-DORE, Nouvelle-Calédonie',
    city: 'MONT-DORE',
    district: 'Mt-Dore',
    googleMapsUrl: null
  },
]
```
