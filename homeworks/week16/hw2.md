## hw2：Event Loop + Scope

```javascript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```

在解釋程式碼如何運行前，先簡單解釋 function scope、static scope。

#### Function Scope
用 var 宣告，變數的生存範圍在 function 裡，也就是 function scope。

#### Static Scope
作用域不因被呼叫的方式而改變，根據程式碼所在的位置而決定作用域，稱為「靜態作用域 (static scope)」。

#### 解釋程式碼運行的順序與原因
以這題為例，因 for 迴圈不是在 function，相當於宣告 i 為全域變數。

雖然 for 迴圈裡的 `console.log('i: ' + i` 以及 setTimeout 裡的欲乘以 1000 毫秒的 i，依序存取到 0、1、2、3、4，但由於 setTimeout 是一種 Web API (以下的 runtime 都是瀏覽器)，交由瀏覽器運行並計時，等運行的時間到會將 setTimeout 的 callback fucntion 移入 callback queque 交由 event loop 監控再決定執行的順序。

故主程式運行時會先馬上印出以下程式碼：

```javascript
i: 0
i: 1
i: 2
i: 3
i: 4
```

接著 call stack 清空，0 秒的時候會將第一個 callback funciton 移入 stack 並執行，而 setTimeout 裡的 `console.log(i)`，依從 **scope chain** 往上一層查找 i，此時 for 迴圈已經跑完，找到全域變數的 i=5 (Global Scope EC 的 AO 的 i 值等於 5)，而 setTimeout 所設定的秒數，是從 0 秒至 4 秒，故從 0 秒開始，每間隔 1 秒印出 5。

var 在迴圈宣告的值儲存在 ，每一圈迴圈執行都會對 i 重新賦值

```javascript
i: 0
i: 1
i: 2
i: 3
i: 4
5
(隔一秒)
5
(隔一秒)
5
(隔一秒)
5
(隔一秒)
5
```

#### evnet loop + scope 動圖解釋
![](https://i.imgur.com/xP6EBvt.gif)


#### 參考資料
[重新認識 JavaScript: Day 18 Callback Function 與 IIFE](https://ithelp.ithome.com.tw/articles/10192739?sc=rss.qu)