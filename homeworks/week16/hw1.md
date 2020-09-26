 ## hw1：Event Loop
 
 ```javascript
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
 ```

為了解上述程式碼的運行順序，要先分別解釋什麼是 call stack 、 setTimeout、event loop。

#### call stack
函式呼叫時會產生執行環境，當多個函示被呼叫就會產生多個執行環境，並依序堆疊上去，這稱為執行堆疊 (call stack)。

call stack 是後進先出 (LIFO, last in, First out)，也就是後執行的先離開

#### setTimeout
setTimeout 不存在 JavaScript 的原始碼內，是由瀏覽器提供的 Web API。因 Web API 通常會耗時，為了不影響 JavaScript 的主程式運行，JS 引擎會略過 setTimeout， JS 引擎持續運行下去，同時瀏覽器根據 setTimeout 給定的時間開始計時。

而 setTimeout，等到給的時間結束後並非直接執行，會等待整個 JS 的執行環境結束，call stack 清空之後再將 setTimeout 送入 call stack 再執行。

#### evnt loop
event loop 決定事件的執行順序，會不斷監控 call stack 以及 event queque。

##### 運行順序
1. 檢查 call stack 是否為空，若為空進入 2.
2. 檢查 callback queque，並將 callback queque 依序移入 call stack
3. 回到步驟 1.

#### 解釋程式碼運行的順序與原因
1. `console.log(1)` 進入 call stack 執行 `console.log(1)`，印出 1，`console.log(1)` 離開 call stack。
2. **第一個 setTimeout 的函式**進入 stack 執行，但因是 Web API，故被 JS 引擎略過，JS 主程式繼續運行下去，但同時瀏覽器開始計時。
3. 而**第一個 setTimeout 的函式**，因設置 0 毫秒的關係，立刻等待完成便移入 callback queque
4. `console.log(3)` 進入 call stack 執行 `console.log(3)`，印出 3，`console.log(3)` 離開 call stack。
5. **第二個 setTimeout 的函式**進入 stack 執行，但因是 Web API，故被 JS 引擎略過，JS 主程式繼續運行下去，但同時瀏覽器開始計時。
6. 而**第二個 setTimeout 的函式**，因設置 0 毫秒的關係，立刻等待完成便移入 callback queque
7. `console.log(1)` 進入 call stack 執行 `console.log(1)`，印出 1，`console.log(1)` 離開 call stack。
8. 這時因 call stack 已經清空，故**第一個 setTimeout 的函式**移入 call stack 執行，印出 2，執行完畢離開 call stack。
9. 這時 call stack 已清空，**第二個 setTimeout 的函式**移入 call stack 執行，印出 5，執行完畢離開 call stack。

#### evnet loop 動圖解釋
![](https://i.imgur.com/guZzVDc.gif)

**總結**：依序印出 1、3、5、2、4。

#### 參考資料
- [JS 原力覺醒 Day13 - Event Queue & Event Loop 、Event Table](https://ithelp.ithome.com.tw/articles/10221944)
- [[第十六週] JavaScript 進階：事件迴圈 Event Loop、Stack、Queue](https://yakimhsu.com/project/project_w16_EventLoop.html)