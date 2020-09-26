## Webpack 是做什麼用的？可以不用它嗎？
#### 簡介
在 Node.js 這個 runtime 上支援 CommonJS，可使用 require/exports，輕鬆引入或輸出第三方模組，但瀏覽器不知支援 require/exports 語法，故模組便無法在瀏覽器上使用。

而 Webpack 是一個「打包工具」。可引入第三方模組，並將眾多模組與資源打包成一包檔案，並編譯我們需要預先處理的檔案，變成瀏覽器看得懂的內容。

#### 是否可以不用 webpack
**可以不用 webpack**，前端沒有支援或支援度很差的的功能可以自行寫出來。但 webpack 相當好用能做的事情相當多，能將新語法轉為舊語法、將 SASS/SCSS 轉為 CSS，或是處理不同模組間所造成的全域變數命名衝突的問題，而現在框架也都會用到 webpack，工作開發上不用 webpack 的情況可能較少。

## gulp 跟 webpack 有什麼不一樣？
#### gulp
任務管理器 (task manager)，將 ES6 轉為 ES5 或是將 SASS 轉為 CSS，要安裝相對應的 plugin 才能順利執行。因是 gulp 是 task manager，故 webpack 也可作為 gulp 的其中一個 task 執行。

#### webpack
打包工具，而在打包的過程中可利用 webpack 的 plugin 再處理檔案，例如 minify, uglify，最後處理成瀏覽器看得懂的內容並打包成一個檔案。

此外，雖然許多資源可以被 webpack 打包，但把圖片或是 CSS 當作資源引入不是正式規範，webpack 為了延伸可以載入的資源，要額外寫一個 loader 去載入，這樣 loader 就不只可載入 JavaScript，也可載入圖片、CSS、字型等各式各樣的資源。

## CSS Selector 權重的計算方式為何？
權重分為五位數，權重高的選擇器，優先套用，權重高如下：
- !important
- Style attribute(inline style)
- id
- Classes, attributes and pseudo-classes
- Elements and pseudo-elements

若權重相同，則套用寫在檔案最下方的 CSS 選擇器。

**舉例如下**
最後超連結文字顏色為紅色
![](https://i.imgur.com/zBIprbL.png)

**權重排序**
「0, 1, 2」 > 「0, 1, 1」 > 「0, 0, 2」
![](https://i.imgur.com/DsEiPPM.png)