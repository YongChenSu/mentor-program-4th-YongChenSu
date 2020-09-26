## hw4：What is this?
```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // ??
obj2.hello() // ??
hello() // ??
```

this 是根**據呼叫的情況而決定 this 的值**。先解釋 this 在各個情況下的值是什麼：

1. 在非物件導向下
    - 嚴格模式 ('use strict')：this 為 undefined
    - 非嚴格模式：根據 runtime 決定；node.js 為 global，瀏覽器上為 window。
2. 在物件導向下，this 就是自己的 instance
3. 在 addEventListener 下，操作到的東西是 this。
4. 在 obj 下，將其轉換為 .call() 的形式，this 是 .call() 內第一個參數。

##### obj.inner.hello() // ？？
`obj.inner.hello()`，將其轉為 call 的型式來看的話，變成

```javascript
obj.inner.hello.call(obj.inner)
```

this 便是 `obj.inner`，而 `obj.inner.hello()` 呼叫 hello 的值也就是

```javascript
function() {console.log(this.value)}
```

上面有提過 this 是 `obj.inner`，所以最後將 `obj.inner.value` 的值印出，印出 2。

**此時一共印出**
```javascript
2
```

##### obj2.hello() // ？？
將 `obj2.hello()` 轉為 call 的形式來看，`obj.inner.hello.call(obj.inner)`，所以結果跟上面一樣，印出 2。

**此時一共印出**
```javascript
2
2
```

##### hello() // ？？
在非物件導向、非嚴格模式下，呼叫 hello 函式，依舊將其轉為 call 的形式來看。

在不同的執行環境 (runtime) 下，傳入 call 第一個參數的值不同，在瀏覽器下是 window，在 node.js 下是 global，所以轉為 call 的形式變成：`hello.call(window)/hellow.call(global)`

因已將 hello 賦值為 `obj.inner.hello`，`hello()` 會執行 `console.log(this.value)`，欲印出 this.value 的值。而無論 runtime 是瀏覽器或是 node.js，在全域環境中都找不到 value 的值，故都會印出 undefined。

**最後一共印出**
```javascript
2
2
undefined
```

#### 參考資料
- [淺談 JavaScript 頭號難題 this：絕對不完整，但保證好懂](https://blog.huli.tw/2019/02/23/javascript-what-is-this/)