function reverse(str) {
  let result = ''
  for (let i = str.length - 1; i >= 0; i--) {
    result += str[i]
  }
  console.log(result)
}

reverse('hello');

// Method2：使用內建函式
function reverseStr(str) {
  let result = ''
  for (let i = str.length - 1; i >= 0; i--) {
    result += str[i]
  }
  console.log(result)
}
