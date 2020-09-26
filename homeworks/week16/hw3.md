## hw3：Hoisting

```javascript
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

hoisting 提升的順序
function
arguments (參數)
var


### AO、VO 解釋
- 每一個 Excution Context 都有一個 scope chain
- 當進入新的 Excution Context，scope chain 就會被建立並初始化。
- 當進入 function code 的時候，scope chain 會新增 activation object (AO)，還有會新增預設的屬性 arguments。AO 可當作 variable object(VO) 來用。
- global EC 裡面有 VO。


##### 1. 建立 globalEC 並初始化 globalEC.VO 以及 scopeChain
```javascript
globalEC: {
  VO: {
  
  },
  scopeChain: [globalEC.VO]
}
```

##### 2. 初始化 a 及 function fn
```javascript
globalEC: {
  VO: {
    a: undefined,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}
```

##### 3. 設定 function fn 的 scope 屬性
```javascript
globalEC: {
  VO: {
    a: undefined,
    fn(): func ,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 4. globalEC.VO 裡的 key 取得 value。
```javascript
globalEC: {
  VO: {
    a: 1,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 5. 呼叫 fn，初始化 fnEC.AO 以及 fnEC.AO.scopeChain
```javascript
fnEC: {
  AO: {
    
  },
  scopeChain: [fnEC.AO, globalEC.VO]
}

globalEC: {
  VO: {
    a: 1,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 6. 設定 function fn2 的 scope 屬性
```javascript
fnEC: {
  AO: {
    a: undefined,
    fn2: func,
  },
  scopeChain: [fnEC.AO, globalEC.VO]
}
fn2.[[Scope]] = [fnEC.AO, globalEC.VO]

globalEC: {
  VO: {
    a: 1,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 7. 遇到 function fn 裡第一個 console.log(a)，印出 undefined
從 scopeChain index 0 開始，是 fnEC.AO，裡面的 a 值為 undefined。

即便這邊的 console.log(a) 的下一行程式碼有 var 宣告 a 並賦值，但由於 var hoisting 特性的關係，僅將宣告提升，並不會賦值，故此時的 a 為 undefined。
(p.s. 若下一行是用 let 宣告，則會出現`Uncaught ReferenceError: Cannot access 'a' before initialization` 的錯誤。)

**此時一共印出**
```javascript
undefined
```

##### 8. 將 a 值賦予 5
```javascript
fnEC: {
  AO: {
    a: 5,
    fn2: func,
  },
  scopeChain: [fnEC.AO, globalEC.VO]
}
fn2.[[Scope]] = [fnEC.AO, globalEC.VO]

globalEC: {
  VO: {
    a: 1,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 9. function fn 裡第二個 `console.log(a)` 印出 5
找 fnEC.AO 裡的 a 值，印出 5。

**此時一共印出**
```javascript
undefined
5
```

##### 10. a++ 將 a 值改為 6
```javascript
fnEC: {
  AO: {
    a: 6,
    fn2: func,
  },
  scopeChain: [fnEC.AO, globalEC.VO]
}
fn2.[[Scope]] = [fnEC.AO, globalEC.VO]

globalEC: {
  VO: {
    a: 1,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 11. 因已經宣告過變數 a 了，故 `var a` 不影響。

##### 12. 呼叫 fn2，初始化 fn2EC.AO、fn2EC.scopeChain
由於 JavaScript 的函式會 hoisting 的關係，初始化 fn2EC.AO、fn2EC.scopeChain。

```javascript
fn2EC: {
  AO: {

  },
  scopeChain: [fn2EC.AO, fnEC.AO, globalEC.VO]
}

fnEC: {
  AO: {
    a: 6,
    fn2: func,
  },
  scopeChain: [fnEC.AO, globalEC.VO]
}
fn2.[[Scope]] = [fnEC.AO, globalEC.VO]

globalEC: {
  VO: {
    a: 1,
    fn(): func,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 13. function fn2 裡的 `console.log`，印出 6
找 fn2.EC.scopeChain：[fn2EC.AO, fnEC.AO, globalEC.VO]，從 index 0 開始找，fn2E.AO 沒有 a 值，繼續找 index 1，此時 fnEC.AO.a 為 6，故印出 6。

**此時一共印出**
```javascript
undefined
5
6
```

##### 14. 運行至 `a = 20`
從 fn2.EC.scopeChain 的 index 0 開始找 a，最後將 fnEC.EO.a 的值設為 20。

##### 15. 運行至 `b = 20`
從 fn2.EC.scopeChain 的 index 0 開始找 b，找到最上層 globalEC.VO，設定 `b = 100`。

##### 16. `fn2()` 結束並離開
```javascript
fnEC: {
  AO: {
    a: 20,
    fn2: func,
  },
  scopeChain: [fnEC.AO, globalEC.VO]
}
fn2.[[Scope]] = [fnEC.AO, globalEC.VO]

globalEC: {
  VO: {
    a: 1,
    fn(): func,
    b: 100,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 17. `fn2()` 結束後，繼續執行下一行的 `console.log(a)`，印出 20
找 fnEC.scopeChain: [fnEC.AO, globalEC.VO]，從 index 0 開始找，找到 fnEC.AO.a 的值為 20。

**此時一共印出**
```javascript
undefined
5
6
20
```

##### 18. `fn2()` 結束並離開
```javascript
globalEC: {
  VO: {
    a: 1,
    fn(): func,
    b: 100,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 19. `fn()` 結束後，繼續執行下一行的 `console.log(a)`，印出 1
找 globalEC.scopeChain: [globalEC.VO]，依序從 index 0 開始找，找到 a 為 1。

**此時一共印出**
```javascript
undefined
5
6
20
1
```

##### 20. 運行至 `a = 10`
將 fnEC.AO.a 設為 10。

```javascript
globalEC: {
  VO: {
    a: 1,
    fn(): func,
    b: 100,
  }
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = [globalEC.VO]
```

##### 21. 運行 `a = 10` 下一行的 `console.log(a)`，印出 10
找到 fnEC.AO.a 的值為 10。

**此時一共印出**
```javascript
undefined
5
6
20
1
10
```

##### 22. 運行至 `console.log(b)`，印出 100
找到 globalEC.VO.b 的值為 100。

**最後一共印出**
```javascript
undefined
5
6
20
1
10
100
```

#### 參考資料
- [我知道你懂 hoisting，可是你了解到多深？](https://blog.huli.tw/2018/11/10/javascript-hoisting-and-tdz/)
- [前端中階作業：event loop、Scope、hoisting、closure](https://medium.com/@hugh_Program_learning_diary_Js/%E5%89%8D%E7%AB%AF%E4%B8%AD%E9%9A%8E%E4%BD%9C%E6%A5%AD-event-loop-scope-hoisting-closure-ffa02ed722fb)