## 跟你朋友介紹 Git

## 什麼是 Git？
**Git 是一種「分散式版本控制系統」，可記錄每一個版本的所有變化**。

### 分散式指的是？
雖然有共同的伺服器，但沒有伺服器或是沒有網路的環境，依舊可以使用 Git 來進行版控，待伺服器恢復正常運作或是在有網路的環境後再進行同步，不會受影響。

### 版本控制指的是？
當完成任務，無論是新增、刪除、修改，都會造成目錄和檔案上的變化，每一次的變化稱作一個版本。

![](https://i.imgur.com/xWXUAcH.png)

git 是個內容追蹤軟體，所以非常適合作為版控軟體，git 只在乎檔案內容，不在乎目錄或檔案名稱。
<br>

### Git 與其他版控軟體的差異
有些版控軟體，記錄每一次的差異；Git 則是拍快照 (snapshot)， 只要是沒有異動的檔案，就會指到上一版本，不會再存一次。

![](https://i.imgur.com/NCKzVo8.png)
<br>

## 把檔案交給 Git 控管
![](https://i.imgur.com/NRHV6iJ.png)
<br>

## `git add .` 與 `git add --all` 的差異
- git add -all 不管哪一層目錄執行都有效果，將所有異動加入暫存區。
- git add . 則是當下目錄以及子目錄加入暫存區。
<br>

## SHA1 演算法是什麼？
- SHA-1 算出來的值由 40 個 16 進位字元組成。
**輸入一樣的內容，有一樣的輸出值。輸入不一樣的內容，則有不一樣的輸出值。**
- Git 物件的檔名：SHA-1。Git 物件的內容：檔案內容 + 壓縮。
- 在 git 裡，每一個物件都有自己的 SHA-1 值。
- 碰撞：機率超低，不一樣的輸入內容，卻有一樣的輸出值。
<br>

## 什麼是分支？
- 分支是一個指向某個 commit 的指標。
- 分支是一個 40 個字元的檔案。更改在 `.git/refs/HEAD` 裡的分支檔案名稱，就會更改分支名稱。
- 每一個分支會指向某一個 branch。HEAD 是指向某一個 branch 的指標。

![](https://i.imgur.com/1wxvLKY.png)
<br>

## `git commit` 的過程中發生了什麼事？
- git 裡面有 4 種物件：
  1. blob：檔案有關
  2. tree：目錄有關
  3. commit
  4. tag
- 當把檔案加到暫存區時，git 長出 blob 物件
- 當 commit 的時候，git 長出 tree 物件
- 當 commit 完成的時候，長出 commit 物件
- 最後長出 tag 物件，指向 commit 物件
- 所有 commit 物件都會指向前一個物件

![](https://i.imgur.com/Z7EROj5.png)
<br>

## `git commit` 實際運作流程
- `ehco "hello" > index.html`：新增一個 index.html 檔案，內容為 "hello"。
  - 目前為 untracked 狀態。
- `git add index.html`：將檔案加到暫存區 (索引區)。
  - 新增 blob 物件 (fa6556)
- `mkdir config`：建立 config 目錄。
  - 空目錄對 git 來說沒有影響，連 untracked 狀態都算不上。
- `echo "super-secret-password" > config/database.yml`：在 config 目錄下，放檔案內容為 "super-secret-password" 的 database.yml 檔案。
  - 變成 untracked 狀態。
- `git add config/database.yml`：將檔案移到暫存區。
  - 長出 blob 物件 (1e06da)。
- `git commit -m "init commit`"：將檔案移到儲存庫。
  - 長出 tree 物件 (8cfc26)，指向其所包含的 blob 物件 (8cfc26)。
  - 長出 tree 物件 (635706)，指向 blob 物件 (8cfc26) 以及 blob 物件 (fa6556)。
  - 長出 commit 物件 (e076c8)，指向 tree 物件 (635706)。
<br>

![](https://i.imgur.com/kIAbzvv.png)

- `ehco "this is a book" > index.html`：修改 index.html 檔案內容。
  - index.html 的狀態變成 modified
- `git add index.html`：將檔案移到暫存區。
  - 根據 SHA-1 演算法做出新的 blob 物件 (7ffd42)。
- `git commit -m "update index.html"`：將檔案移到儲存庫。
  - 做出新的 tree 物件指向 blob 物件 (7ffd42)。
  - 但 congfig 目錄沒有變，故指向原來的 tree 物件 (8cfc26)。
  - 產生一個 commit 物件 (35c42e) 指向新產生的 tree 物件 (afa760)。
  - commit 物件 (35c42e) 指向前一個 commit 物件 (e076c8)。
  - master, HEAD 往前移動，完成這次 commit。
- `echo "super-secret-password" > key.txt`：在根目錄放 key.txt 檔案。
  - 故意內容與剛才的一樣。
  - 檔案狀態是 untracked。
- `git add key.txt`：將檔案移到暫存區。
  - 因為檔案內容一樣，不會產生新的 blob 物件，現在就有算出來一樣的 SHA-1 值了。
- `git commit -m "add secret key"`
  - 產生 tree 物件 (9e6de0)，指向已存在的 blob 物件 (1e06da)。
  - 因 database.yml 沒有異動，tree 物件 (9e6de0) 同時指向 blob 物件 (7ffd42)。
  - 因 config 沒有異動，tree 物件 (9e6de0) 指向 tree 物件 (8cfc26)
  - 新產生的 commit 物件 (b43d89) 指向前一個 commit 物件 (35c42e)。
  - master, HEAD 往前移動，完成這次 commit。

![](https://i.imgur.com/B1F37wQ.png)
<br>

## `git checkout 某個分支` 的運作流程？
1. 把 Repo 裡的東西搬一份出來到工作目錄。
2. 變更 .git/HEAD 內容。

![](https://i.imgur.com/Qo5bv9h.png)
<br>

## 想要拆掉重做 commit？
- `git reset e12d8ef^`：拆掉最後一次的 commit (最後一次 commit 的 SHA-1 值是e12d8ef)。
- ^ 代表前一次的意思，若要倒退五次則會寫成 `git reset e12d8ef~5`。

reset 是把 HEAD (最新 commit 點) 移動到指定結點上，而後綴字的差異，則是恢復的範圍，決定是否把原來 working tree 或 index 中的資料內容一起 reset 成指定結點。

**reset 指令比較像是前往或變更**

- `git reset --mixed`：當沒有下任何參數時，預設是 mixed 模式。把暫存區的檔案丟掉，但不會動到工作目錄的檔案，也就是 commit 拆出來的檔案會留在工作目錄，但不會留在暫存區。
- `git reset --soft`：這個模式下的 reset，工作目錄跟暫存區的檔案不會被丟掉，只有 HEAD 移動，commit 拆出來的檔案會直接放在暫存區。
- `git reset --hard`：無論工作目錄、暫存區的檔案都丟掉。

### 各模式比較
| 模式     | mixed  |  soft | head |
| ---     | ---    | --     | --  |
| 工作目錄   | 不變    | 不變   | 丟掉 |
| 暫存區   | 丟掉    | 不變   | 丟掉 |

### 白話說明
| 模式     | mixed  |  soft | head |
| ---     | ---    | --    | ---  |
| 工作目錄   | 丟回工作目錄   | 丟回暫存區   | 直接丟掉 |
<br>

## 沒合併過的分支刪掉還可救回來？
- `git branch -d cat`：刪掉 cat 分支 (尚未 merge 的話不可刪)。
- `git branch -D cat`：刪掉 cat 分支 (尚未 merge 也能刪除)。
- `git branch new_cat SHA-1`：新增分支，參數接被刪除的 cat 分支的 SHA-1 值，即可回復。
- 即便 `git reset HEAD~2 --hard`：也可利用 `git reflog`，列出每個節點，再 `git reset SHA-1 --hard` 再救回 (切回)。

## 什麼是標籤 (tag)？
標籤不會隨著 commit 前進。
<br>

## 其他 git 指令筆記
- `git log --oneline`：一行顯示 git 紀錄
- `cat .git/refs/heads/master`：可叫出 master SHA-1 值。
- `git branch`：查看目前我所在的分支。
- `git checkout -b cat`：製造 cat 這個分支，同時切換過去。
- `git hash-object --stdin`：可以計算 SHA-1 值。
- `git count-objects`：可算出總共有幾個物件。
- `git gc`：手動啟動資源回收機制 (Garbage Collection)。
