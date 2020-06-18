## 教你朋友 CLI

## 什麼是 CLI？
CLI 是**命令列介面** (Command-Line Interface)，是與電腦互動的指令。
GUI 是**圖形化介面** (Graphical User Interface)。

而任何第三方所開發的 GUI，最終也是透過 CLI 指令。
<br>

## CLI 常用指令有哪些？
windows 作業系統為例，常用的指令如下：

| 指令    | 說明           |
| ---    | ---            |
| cd     | 切換目錄        |
| cd ..  | 往上一層目錄移動 |
| cd -al | 往上一層目錄移動 |
| pwd    | 取得目前所在位置 |
| ls     | 列出目前檔案列表 |
| touch  | 新增檔案        |
| mkdir  | 新增目錄        |
| cp     | 複製檔案        |
| mv     | 移動檔案        |
| rm     | 刪除檔案        |
| cat    | 印出檔案內容     |
| clear  | 清除畫面上的內容 |
<br>

## 為什麼無法使用 touch 新增檔案？
然而，VSCode 預設無法使用 touch，故要先安裝 git，重新設定使 VSCode 使用 git bash，設定的方法可參考這篇文章：[VSCode 入門-終端機與殼層](https://medium.com/az-%E4%B8%8B%E7%AD%86%E8%A8%98/vs-code-%E5%85%A5%E9%96%80-%E7%B5%82%E7%AB%AF%E6%A9%9F%E8%88%87%E5%B8%B8%E7%94%A8%E6%8C%87%E4%BB%A4-9c9bf5ed04bd)。

**可直接在 Terminal 上輸入其他 Terminal 的名稱，例如：`powershell`、`bash`，即可直接切換 Terminal。**
<br>

## 指令練習
![](https://i.imgur.com/maJktHT.png)

再複習一次

:::info
- ls：列出目前檔案列表
- ls -a：列出包含小數點開頭的檔案 (.gitignore)
- ls -l：列出檔案完整資訊
:::
<br>

## 參考資源
- [Git 教學：終端機及常用指令介紹](https://gitbook.tw/chapters/command-line/command-line.html)
- [如何在 vscode 使用多種 shell 於終端機上](https://medium.com/@jackaly9527/%E7%9A%AE%E6%AF%9B%E7%AD%86%E8%A8%98-%E5%A6%82%E4%BD%95%E5%9C%A8vs-code%E4%BD%BF%E7%94%A8%E5%A4%9A%E7%A8%AEshell%E6%96%BC%E7%B5%82%E7%AB%AF%E6%A9%9F%E4%B8%8A-f89ce1e59fea)