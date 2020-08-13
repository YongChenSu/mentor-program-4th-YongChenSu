## 什麼是 Ajax？
Ajax 是 Asynchronous JavaScript and XML 的縮寫，並非一種「技術」，指的是使用數個目前既有技術的「方法」或「術語」。雖然名稱裡有 XML，但不限定只交換 XML 的資料，**任何非同步跟伺服器交換資料的 JS 都可統稱為 Ajax**，現在常用的格式是 JSON。

透過 Ajax，能讓 Web 應用程式能快速且即時更動內容，可與伺服器非同步更新，不須重新載入頁面。一個常見的 Ajax 應用例子是信箱資料驗證，無須等所有資料填完，即可知道資料：信箱、用戶名，是否重複。
<br>

## 用 Ajax 與我們用表單送出資料的差別在哪？
最大的差別是用表單送出資料會直接在瀏覽器上換頁，而利用 AJAX 可即時更動內容，無須重新載入頁面。
<br>

## JSONP 是什麼？
JSON with Padding 的縮寫，是 JSON 格式的一種「使用模式」，利用 `<script>` 標籤的 `src` 屬性不受同源政策影響的特性，在 `src` 裡寫 JS 當作發送 request，例如以下程式碼：

```javascript=
<script>
  function setData(users) {
    console.log(users)
  }
</script>

<script src="https://test.com/user.js"></script>

// 可動態產生 script
const element = document.createElement('script')
element.src = 'https://test.com/user.js?id=1'

// user.js
setData(
  {
    id: 1,
    name: 'hello'
  }
)
```

Server 端要提供 JSONP 的方法，才能夠實現，這個方法指的是 server 端提供 callbaback 參數讓 clinet 端帶過去，回傳的 response 要用 callback function 包起來，否則回傳的 response 只是字串，沒辦法取得資料。

- 優點：不受同源政策規範。
- 缺點：只能用附加在網址上的方式 (GET)，不可使用 POST。
<br>

## 要如何存取跨網域的 API？
一般來說欲存取跨網域的 API，須符合 CORS (cross-orgin resource share) 規範，而 JSONP 方法不受忽略 CORS 的限制。

存取跨網域 API 是從 clinet 端發送請求 (request)，請求分為簡單請求 (Simple Reqquest) 以及非簡單請求。若是非簡單請求會先將請求擋下並發送預檢請求 (Preflight request)。

### 簡單請求 (Simple Request)
![](https://i.imgur.com/qC5Bd6m.png)

簡單請求直接將請求送出，server 端會回傳回覆 (response)。瀏覽器收到回覆後根據同源政策，檢查回覆的 Header 有沒有 Access-Control-Allow-Origin 的欄位，和它的值是否符合條件，例如`Access-Control-Allow-Origin: *`，代表任何來源皆可請求資源；若條件不符合則把回覆的內容擋下，並提示錯誤。

### 預檢請求 (Preflight Request)

![](https://i.imgur.com/ixP3qfx.png)

若是非簡單請求，則會先將請求擋下，然後發送一個預檢請求 (可能帶上使用者資料)，伺服器回覆之後，瀏覽器會根據回覆的內容決定是否將真正的請求發送出去。例如瀏覽器檢查 Access-Control-Allow-Origin、Access-Control-Allow-Methods、Access-Control-Allow-Headers 等欄位，若符合條件便將真正的請求 (Main request) 發送出去。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
第四週的作用是在 node.js 這個 runtime，發送 request 到 server，可直接拿到 server 的 response，

透過瀏覽器這個 runtime 的話，無論 request 或 response 都會被瀏覽器規範，跨網域的規範便是其中之一，故需要了解需了解瀏覽器上的規則。
<br>

## 參考資源
- [[web 筆記] 初探跨來源資源共用 (CORS)](https://medium.com/@a663321765/web-%E7%AD%86%E8%A8%98-%E5%88%9D%E6%8E%A2%E8%B7%A8%E4%BE%86%E6%BA%90%E8%B3%87%E6%BA%90%E5%85%B1%E7%94%A8-cors-129e88dbca87)
