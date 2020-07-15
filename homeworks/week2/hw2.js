/* eslint-disable */
// Method1：盡量不使用內建函式
function capitalize(str) {
  let firstLetter = ''
  let remainingStr = ''
  if (str.charCodeAt(0) >= 97 && str.charCodeAt(0) <= 122) {
    firstLetter = String.fromCharCode(str.charCodeAt(0) - 32)
    for (let i = 1; i < str.length; i++) {
      remainingStr += str[i]
    }
    return firstLetter + remainingStr
  }
  return str
}

console.log(capitalize('hello'))
