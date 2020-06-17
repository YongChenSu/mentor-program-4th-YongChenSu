## 挑戰題
## 什麼是 Shell Scripts？
什麼是 shell script (程式化腳本) 呢？我們將它拆為兩部份說明：

#### 「shell」的部分說明：
CLI 底下與系統溝通的工具介面。

#### 「script」的部分說明：
script 腳本、劇本的意思。

#### 「shell scripts」一起說明：
針對 shell 所寫的劇本，是利用 shell 功能所寫的程式 (program)，使用純文字檔，將 shell 的語法、指令 (包含外部指令) 寫在裡面，搭配正規表達式 (regular expression)、管線命令 (pipe)、資料流重新導向功能，以達成目的。
<br>

## 產生檔名 1 ~ n 的 JS 檔案
```javascript=
#!/bin/bash
# Program:
#       Create js files from one to n.
# History:
# 2020/06/17


read -p "Please input a number, I will create js files, file names from 1 to: " number

for (( i=1; i<=${number}; i=i+1 ))
do
        touch ${i}.js
done
echo "Created js files, file names from 1 to ${number}."

```