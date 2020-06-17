## 請解釋後端與前端的差異。

## 前端
前端開發者的目標，是根據網頁設計師的設計圖，建立流暢、友善的使用者介面，讓使用者可以順利地與產品互動，找到並使用網站上的各種功能。同時，不斷優化產品的效能（例如：網頁載入時間）也是前端開發者重要的工作。

在網站的功能中，若有涉及資料庫，前端工程師就必須要和後端工程師合作。以臉書為例，前端工程師建立了個人資料頁面，讓用戶可以輸入姓名生日等個資並放上大頭貼，但需要串接到後端工程師建立的資料庫，讓用戶輸入的資料能夠被妥善儲存，此個人資料頁面才是一個完整的功能。

![](https://i.imgur.com/PUlOHFd.png)
<br>

### 前端所需基本技能
- HTML
- CSS
- Javascript

### 前端所需進階技能
- CSS Framework （Bootstrap）
- JavaScript framework （如Angularjs、Reactjs）
- CSS processor（sass，less，stylus）
- RWD Design
- Grunt、Gulp（自動化工具）
<br>

## 後端
雖然有前端工程師打造網站的「門面」，但若要將網站上的各種功能付諸實現，例如儲存使用者帳戶資訊、購物紀錄、推薦商品、驗證帳號密碼、計算用戶點讚的內容，則需要後端工程師。

後端工程師的目標，就是**處理資料**，讓伺服器在茫茫資料海中，最快速地做出適合的運算，提供使用者想要的資料。為了達到這個目標，後端工程師必須要建立並優化伺服器的性能、程式碼邏輯、以及資料庫結構。

除了資料庫、伺服器，演算法也是後端工程師常要負責的項目。演算法與商業邏輯息息相關，例如當臉書決定要減少塗鴉牆上的商業廣告、或是電商希望增加某樣商品出現在推薦系統的頻率，後端工程師就需要調整演算法，讓網站上的應用程式能夠實現業主期望的商業邏輯。

### 後端所需基本技能
- 主要開發語言（PHP、Ruby、C#）
- 資料庫語法（MySQL、SQL Server）
- 伺服器設定（apache、nginx）
- 基本的資安防範（xss、sql injection）

### 後端所需進階技能
- Framework（框架）
- PHP：Laravel、Codeigniter、yii …
- Ruby：Lotus …
- C#.NET：MVC5 …
- 串第三方API（金流、簡訊寄送服務 ..）
- API設計（以目前形態來說，多數公司會讓後端工程師從資料庫取出資料撰寫成json格式提供給前台去呈現資料）
- Cloud(雲端操作) （Google Cloud、Microsoft Azure、Amazon Web Services (AWS)）

## 假設我今天去 Google 首頁搜尋框打上：JavaScri[t 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
1. client 送出一個 request，到 server
2. server 把 rerequest，存到 database 裡面
3. 成功存到 database 裡面之後，server 把 response (結果) 回傳到 client

![](https://i.imgur.com/Ud5OELk.png)


## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
| 指令    | 說明           |
| ---    | ---            |
| tail   | 印出檔案的最後幾行 |
| cat    | 印出檔案內容     |
| clear  | 清除畫面上的內容 |