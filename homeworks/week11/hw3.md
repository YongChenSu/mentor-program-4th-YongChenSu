## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
#### 雜湊與加密的差異？
**雜湊**：透過演算法將無限的輸入，轉變成有限且特定長度的輸出，亦即多對一個關係，所以即便拿到輸出的資料，也無法反推回原始輸入是多少。另外雜湊的特性是，同樣的輸入經過雜湊後保證得到相同的輸出。

**加密**：有限的輸入得到有限的輸出，加密需要密鑰，相同的 key 才可還原本資料，可反推原始資料是多少。

**簡單總結**：加密可逆，雜湊不可逆

#### 為什麼密碼要雜湊後才能存入資料庫？
若直接存明碼有資安上的疑慮，假設資料庫被駭，駭客拿到明碼，即可拿該組帳密去嘗試登入其他網站，若登入成功便能冒用他人的身分。網站管理者也有可能刻意或不小心洩漏帳密資訊，故應要將密碼雜湊後存入資料庫。
<br>

## `include`、`require`、`include_once`、`require_once` 的差別
- require：
  1. require 進來的檔案，成為整體程式的一部分，無法利用迴圈或條件判斷改變執行方式。
  2. 在執行時，如果 require 進來的檔案發生錯誤的話，會立刻中止程式，不再往下執行。

- require_once：
  1. 功能同上，但僅引入一次，亦即會檢查其他地方是法引入過相同的檔案。

- include：
  1. 可利用迴圈或條件判斷改變執行方式。
  2. 在執行時，如果 include 進來的檔案發生錯誤的話，會顯示警告，不會立刻停止。

- include_once：
  1. 功能同上，但僅引入一次，亦即會檢查其他地方是法引入過相同的檔案。
<br>

## 請說明 SQL Injection 的攻擊原理以及防範方法
在 client 端輸入惡意程式碼，改變 query 提取資料的方式，以下是 SQL Injection 的各種攻擊方式。

- 只要知道 username，不需密碼即可登入
```php=
SELET * from users
WHERE username = '%s', password = '%s'

// 使用者輸入帶有特殊符號的 username
username: 'aa'#'
password: 'bbb'

// aa 後面的字符都被註解掉
SELECT * from users
WHERE username = 'aa'#', passworwd = 'bbb'
```

- 把所有資料取出來
```php=
SELET * from users
WHERE username = '%s', password = '%s'

// 使用者輸入帶有特殊符號的 username
username: '' or 1=1#
password: 'bbb'

// 1 = 1 為 true，把資料庫所有東西取出來
SELECT * from users
WHERE username = '' or 1=1#, passworwd = 'bbb'
```

- 改變使用者名稱並新增兩筆資料，可模仿任何人發文
```php=
// 原本的 sql query
INSERT INTO comments(nickname, content)
VALUES ('%s', '%s')

// 惡意的 content
content: '), ('admin', 'test)#

INSERT INTO comments(nickname, content)
VALUES ('aa', ''), ('admin', 'test')
```

- 在內容新增 sql query
```php=
// 惡意的 content
content: '), ((SELECT username from yongchen_users3 WHERE id = 30), (SELECT password from yongchen_users3 WHERE id = 30))#

INSERT INTO yongchen_comments3(nickname, content)
VALUES ('cc', ''), ((SELECT username from yongchen_users3 WHERE id = 30), (SELECT password from yongchen_users3 WHERE id = 30))#
```
<br>

#### SQL INJECTION 的防範方法：preparee staetment
```php=
$sql = 
  "INSERT INTO comments(nickname, content)
  VALUES(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $content);
  $result = $stmt->execute();
```
<br>

##  請說明 XSS 的攻擊原理以及防範方法
XSS (Cross-Site Scripting)，攻擊原理是利用 client 端輸入惡意程式碼並執行，就有可能從該網站取得其他使用者的個人資料或帳密，或者其他使用者被導引到釣魚網站，再利用釣魚網站取得帳密

#### 把一段惡意程式碼作為輸入資料
在沒有做 XSS 攻擊防範的網站，可輸入程式碼獲取 cookie 或資料

```javascript=
<script>alert(document.cookie)</script>
// PHPSESSID=v071tine06kvn91fje9d0n28q
```

#### 防範 XSS: htmlspecialchars
永遠不要相信來自 client 端的資料，以下將 client 端的資料，利用 php 內建的函式跳脫處理，防範 XSS 攻擊。

```javascript=
// utils.php
function escape($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}
```
<br>

## 請說明 CSRF 的攻擊原理以及防範方法
#### CSRF 攻擊原理
Cross Site Request Forgery( 跨站請求偽造)，也稱作 one-clicl attack，駭客利用隱藏的圖片或表單，在使用者點選後發送 request 到駭客的目標網站，若使用者在目標網站仍保持登入狀態，就進而能達到駭客想要的操作。

舉來來說，使用者於 A 網站仍保持登入狀態 (session 週期尚未過期)，到駭客所提供的 B 網站點選，但在使用者不知情的情況下發送 request 到 A 網站，達到駭客的目的。

總結：CSRF 就是在不同 domain 下偽造使用者本人發出的 request

#### 防範方法
- ##### 使用者方面：
因是在登入狀態才會成立的攻擊方式，故使用者可每次使用完網站後便登出。

- ##### server 方面：
  ##### 1. 圖形驗證碼：
  於網站上加上圖形驗證碼，缺點是每次都要驗證，若非金流相關的操作，可能造成使用者體驗不佳。

  ##### 2. 檢查 refer 欄位：
  request 的 header 會帶一個欄位：refer，代表這個 requset 是從哪邊來的，可檢查該欄位是不是合法的 domain，若非則 reject。但有些瀏覽器不會有 refer，否則會擋下真的使用者所發出的 request。另外，還有判定是否為合法 domain 要完善沒有漏洞。

  ##### 3. 加上 CSRF token：
  由 server 隨機產生的 csrftoken 存在 server 的 session 中。在表單按下 submit 之後 server 比對 csrftoken 表單中的 csrf 與自己 server 中的是否相同。但在 server 「支持 cross origin 的 requset 」以及「接受攻擊者 domain 的 request」的狀況下，攻擊者可在他的頁面發起 request 試圖拿到 csrftoken，再拿這組 csrftoken 攻擊目標網站。

  ##### 4. Double Submit Cookie
  在 cookie 與 form 設置相同的 csrftoken，server 比對兩者是否有值並相等，即可判定是否為使用者發出的 request。因瀏覽器的限制，攻擊者無法在他的 domain 設置其他 domain 的 cookie，固可阻擋攻擊。

- ##### browser 方面 (SameSite cookie)：
  在 set-cookie 的 session_id 之後加上 SameSite 即可啟用功能，防範 csrf 攻擊，分為 Strict 模式與 Lax 模式：

  ##### Strict
  cookie 只允許 same site 使用，任何 cross site request 無法加上該 cookie，亦即瀏覽器認定只有相同 site 才會加上該 cookie，不同 site 則無法。

  ##### Lax
  Lax 模式放寬了限制，GET 方法仍可帶上 cookie，但其他方法例如：POST, PUT, DELETE 就無法帶上 cookie。