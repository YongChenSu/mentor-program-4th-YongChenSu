## 交作業流程
1. 在「設定 GitHub 專案」的課程影片上方，點選 「GitHuba classroom 網址」
2. 接受邀請後，會自動新增一個 repo，複製一份第四期課綱到自己的 GitHub 帳號底下

   ![](https://i.imgur.com/nKze3TX.png)
   
   metor-program-4th 的後綴詞會是自己的 GitHub 帳號名稱
   
3. git clone `我的 repo 的網址` 到我的電腦裡面
4. 使用 vscode 開啟複製下來的檔案，到 week1 > hw1.md 的檔案完成第一週的第一個作業
5. 新增 Terminal，或使用快捷鍵 `ctrl + ~`
6. 在 Terminal 中開新分支： `git branch week1`
8. 切換到 week1 分支： `git checkout week1`
9. 把檔案加至暫存區、將暫存區的內容移往儲存庫、建立 commit 訊息： `git commit -a -m "Finish week1 hw1"`
10. 接著完成當週其他作業，重複第 9 步驟，唯一不同的是得修改 commit 訊息：`git commit -a -m "Finish week1 hwX"`
12. 完成全部作業後，把 local 的 branch 推到遠端去： `git push origin week1`
13. 到 GitHub 網站上發起 PR，把 week1 merge 到 master
14. 複製 PR 網址並上學習系統繳交作業
15. 待修改完作業，PR merge 之後，切換至 master branch：`git checkout master`
16. 把遠端的 master 及 local 的 master 同步：`git pull origin master` 
17. 刪除已 merge 的 branch：`git branch -d week1`
18. 開始下一週的作業繳交：重複 6 ~ 18 步驟