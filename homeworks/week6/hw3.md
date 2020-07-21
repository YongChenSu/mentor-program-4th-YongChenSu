## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- HTML 標籤列表與說明
  |標籤|屬性與說明|範例|
  |-- |---------|---|
  |&lt;figure&gt;|圖片|&lt;figure&gt;&lt;img /&gt;&lt;/figure&gt;|
  |&lt;figcaption&gt;|圖片標題|&lt;figcaption&gt;標題文字&lt;/figcaption&gt;|
  |&lt;audio&gt;|音樂內容|&lt;audio controls src=""&gt;&lt;audio&gt; <br> control 屬性可提供播放面版|

- 應用上述 3 個 HTML 標籤
```javascript=
<figure>
  <figcaption>Youtube Audio Library</figcaption>
  <audio
      controls
      src="/week6/hw3/Dance_of_the_Mammoths.mp3">
          Your browser does not support the
          <code>audio</code> element.
  </audio>
</figure>
```


<br>

## 請問什麼是盒模型（box modal）
在 CSS 裡面，每個 HTML 元素都可視為一個盒子，可調整多種屬性。

![](https://i.imgur.com/B5MOt7X.gif)

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- display: block
  有該屬性的元素自己佔滿整行 (row)，若有三個元素便排列成三行，可調各種其他屬性。
- display: inline
  有該屬性的元素並排成一行，寬高由自己撐開，無法調整寬高與上下外距 (margin)，但可調整內距 (padding)。
- display: inline-block
  結合上述兩者的優點，有該屬性的元素並排成一行，對外向 inline 屬性，對內則像 block 屬性。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- static
  預設的定位方式，由上而下排列。
- relative
  相對於該元素最初所在的位置做偏移，不會影響其他元素的位置。
- absolute
  - 針對某個參考點做定位，故要在想定位元素的外層設置 relative 屬性
  - 也就是往外層找直到找到不是 static 的元素。
  - 會脫離一般的排版流程，會影響其他元素的位置。
- fixed
  相對於 viewpoint 的位置做定位，固定在同一個地方，即使滑動視窗卷軸也固定在同一位置。
- sticky
  平常是 static，捲動視窗卷軸。元素到指定的地方時變 fixed。