## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
#### 什麼是 DNS？
我們將 www.google.com、www.ntu.edu.tw 等網址稱為完整網域名稱 (Fully Qualified Domain Name, FQDN)，雖然可以方便人類記憶，但是路由器只認得 IP 位址，不認得網址，所以當我們在 browser 輸入 www.ntu.edu.tw 時，用戶端電腦必須先向 DNS server 查詢這個網址所對應的 IP Address，查詢結果是 140.112.8.116，再使用這個 IP 位址來連接這個網址的 WWW 伺服器。

而網域名稱系統 (Domain Name System)，主要的功能就是將人易於記憶的 Domain Name 與人不容易記憶的 IP Address作轉換，也就是將「使用者傳入的域名 (Domain Name) 翻譯成 IP 再回傳給使用者」。

#### Google public DNS 對於 Google 以及大眾的好處？
使用者利用 Google public DNS 造訪各個網站，Google 便能根據使用者造訪網站的類型與頻率建構數位足跡，數位足跡愈清晰，愈能透過分析掌握用戶的偏好。而在這個有人認為我們邁入[監控資本主義](https://www.books.com.tw/products/0010863993)的時代裡，網路上的用戶資料愈真實愈能帶來龐大的商業價值。

Google 這間大公司，擁有相對完整的 domain name/IP，所以使用 Google 的 DNS server：
- 可能相較於其他網路服務供應商更能找到資料。
- 因 Google 是一間相當大的公司，伺服器遍布世界上許多地方，故 DNS server 相對穩定。

#### 參考資料
1. [DNS 是什麼？](https://www.stockfeel.com.tw/dns-%E4%BC%BA%E6%9C%8D%E5%99%A8%E6%98%AF%E4%BB%80%E9%BA%BC%EF%BC%9F%E5%A6%82%E4%BD%95%E9%81%8B%E7%94%A8%EF%BC%9F/)

## 什麼是資料庫的 lock？為什麼我們需要 lock？
#### 什麼是資料庫的 lock？
在多使用者的資料庫(Multi-user Database) 中，會資料鎖定(Locks) 資料來保持資料的一致性(Consistency) 與整合性(Integrity)。Lock 是避免使用者不正確地修改資料同一筆資料。

#### 為什麼我們需要 lock？
以購物網站為例子，若有兩筆以上的 query 同時抵達 server，若商品數量不足，就有可能發生 race condition，而將商品「超賣」，也就是明明沒有庫存商品了卻仍將商品賣出。而 lock 可防止 race condition，可避免「同步寫入」同一筆資料的情況發生。

而資料庫通常會有許多使用者同時「寫入」、「讀取」，若 lock 在第一個使用者寫入或讀取資料時，將整個資料庫的 table 鎖定，其他只用者只能等待第一個使用者使用完畢，故 lock 分成不同的層級 (Lock Granularity)，切分成更小的單位 lock，便能讓許多使用者同時使用該資料庫。

#### lock 的優缺點
優點：可避免同步寫入同一筆資料。
缺點：有可能造成效能低落，因程式執行到設定 lock 的那一行便會先鎖住，直到確定「避免同步寫入同一筆資料」的情況，程式才繼續執行。

#### Lock Escalation
lock 層級(Lock Granularity)提升的過程稱為 lock escalation，可分成：
1. row-level lock：資料庫鎖定的最小單位，是 table 中的一筆紀錄，可降低因同時存取時需要等待的 lock 的機率。
2. key-level lock：發生在 clustered index 的資料上。
3. page-level lock：當交易需要存取多筆資料而產生多個 row-level lock、key-level lock 時，lock manager 就可能選擇 page-level lock。
4. extent-level lock：8 pages = 1 extent
5. tabel-level lock：整個資料表鎖住。




#### 參考資料
1. [9-4鎖定](http://faculty.stust.edu.tw/~jehuang/oracle/ch9/9-4.htm)
2. [資料庫的交易鎖定 Locks](https://www.qa-knowhow.com/?p=383)


## NoSQL 跟 SQL 的差別在哪裡？
#### 差異一：是否有 schema
- NoSQL 沒有 schema，以類似 json 的資料存進 DB，改以 key-value 的方式儲存，每一筆資料間沒有關聯性，可以任意切割或調整，也可分散到不同伺服器中建立副本。因沒有 schema 的緣故，通常無法支援標準的 SQL 語法查詢資料，而是以 API 新增、刪除、更新資料庫中的內容。有些 NoSQL 資料庫稱加 column 的概念，可以以多個 key 對應 value，例如可以使用「使用者帳號」、「個人檔案」、「生日」三個 key 取得生日日期，比起只用 key-value 的資料架構更有彈性，減少資料存取程式的開發難度。

- SQL 有 schema，需要透過 schema 欄位架構建立資料表之間的關聯。當資料龐大時要變更 schema 不容易。

#### 差異二：擴充資料庫的機器差異
- NoSQL 資料庫的另一個重要特性是具有水平擴充能力，只要增加新的伺服器節點，甚至用低價的、一般等級的電腦，就可以不斷擴充資料庫系統的容量，相較於關聯式資料庫，可以較低的硬體成本做出大型的資料庫系統。

- SQL 聯式資料庫需要效能及容量較大的伺服器。

#### 差異三：資料庫理論
- NoSQL 採用 CAP 資料庫理論，分別是一致性(Consistent)、可用性(Availability)、中斷容忍性(Partition Tolerance)。因理論上無法兼顧 CAP 三種特性，故 NoSQL 會選擇其中兩種設計，通常是 CP 或 AP。

- SQL 採用 ACID 理論 (ACID 的解釋寫在下方)。

#### 參考資料
1. [了解NoSQL不可不知的5項觀念](https://www.ithome.com.tw/news/92506)

## 資料庫的 ACID 是什麼？
交易 (transaction) 必須有 ACID 四種特性，才能稱之為交易，以下是四種特性的說明：
  1. atomacity 原子性(不可部分完成性)：資料操作不能只有部分完成。一次的 transaction 只能有兩種結果：成功或失敗。
  2. consistency 一致性：transaction 完成前後，資料都必須永遠符合 schema 的規範，保持資料與資料庫的一致性。
  3. isolationl 隔離性：多筆交易不會互相影響(不能同時改同一個值)。資料庫允許多個 transactions 同時對其資料進行操作，但也同時確保這些 transaction 的交叉執行，不會導致數據的不一致。
  4. durability 持久性：交易成功後，寫入的資料不會不見。transaction 完成後，對資料的操作就是永久的，即便系統故障也不會丟失。

#### 參考資料
[MySQL 基本運作介紹，從資料庫交易與 ACID 特性開始](https://tw.alphacamp.co/blog/mysql-intro-acid-in-databases)

