## 什麼是 DOM？
DOM 全名為 Document Object Model，中文譯名為**文件物件模型**，把 HTML 文件內的各個標籤，包括文字、圖片等等都定義成物件，而這些物件最終會形成一個樹狀結構，圖示如下：

![](https://i.imgur.com/jNC9gVP.png)

許多公司有設計瀏覽器，故需要一個讓各大瀏覽器都能編譯的規範，而 W3S 定義了許多規範，DOM 是其中一個。 
<br>

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
- 捕獲階段```CAPTURING_PHASE```：
由 DOM 樹的最外層依序向內，過程中觸發個別元素的捕獲階段事件監聽。
- 目標階段```AT_TARGET```：
到達事件目標，依照註冊順序觸發事件監聽。
- 冒泡階段```BUBBLING_PHASE```：
由事件目標依序向外，過程中觸發個別元素的冒泡階段事件監聽。

![](https://i.imgur.com/SU7R4HS.png)
<br>


## 什麼是 event delegation，為什麼我們需要它？
利用事件的冒泡機制 (Event Bubbling)，把子節點們的事件統一處理，可避免掛載過多的監聽器。
<br>

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
- event.preventDefault()：阻止網頁預設事件。
- event.stopPropagation()：阻止當前事件繼續捕捉及冒泡階段的傳遞，。

**範例如下：**
[preventDefault & stopPropagation](https://codepen.io/waizcqkc/pen/QWyoPzx?editors=1011)