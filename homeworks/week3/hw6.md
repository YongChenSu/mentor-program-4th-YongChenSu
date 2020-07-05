## hw1：好多星星
- 注意 for 迴圈 console.log 的時機

把 printStar(n) 函式裡的 console.log() 寫在 for 迴圈之外，在 solve() 函式則要再多寫一個 for 迴圈，使其能一層一層遞增星星數。
```javascript=
function solve(lines) {
	let N = Number(lines[0])
	for (let i=1;i <= N; i++) {
		printStar(i)
	}	
}

function printStar(n) {
  let star = ''
  for (let j = 0; j < n; j++) {
		star += '*'
	}
	console.log(star)
}
```

## 
直接將 console.log() 寫在 printStar() 裡的 for 迴圈裡面，這樣的寫法比較簡潔易懂。

```javascript=
function solve(lines) {
	let N = Number(lines[0])
	printStar(N)

}

function printStar(n) {
  let star = ''
  for (let j = 0; j < n; j++) {
		star += '*'
		console.log(star)
  }
}
```

## hw2：水仙花數
之前在上《先別急著寫 leetcode》時已經解過一次了，這次還是沒辦法順利解出來，不過再回去看筆記重新寫過幾次，把在迴圈中「重新賦值的時機」、「取餘數」、「位元運算」的概念再加深。

## hw3：判斷質數
1 既不是質數也不是合數，故傳入 isPrime() 函式的數字為 1，return false。

## hw4：判斷迴文
這題也是之前有解過，先寫一個 reverse() 函式，把字串倒轉過來，再回去判斷是否相等於原來的字串即可。

## hw5：聯誼順序比大小
這一題花好多時間，先使用 BigInt() 解題，一開始沒有意識到 使用 Number(), BigInt() 函式後的型別不一，導致測資一直無法通過。然後到 spectrum 上發問才重新寫過後，解決問題。

接著挑戰不要用 BigInt() 來完成，這個過程了解到，可以利用 for 迴圈來判斷字串裡的數字大小，也知道了字串字典序大小的概念，也複習如何利用三元運算子。

ps. 題目描述的聯誼順序超有趣，在會講話的人後面自介使人「相形見絀」，而在不會講話的人後面發言則可以「藏拙」，實在將青澀的年少時期，在新團體中大家第一次自介的情景描繪地栩栩如生。