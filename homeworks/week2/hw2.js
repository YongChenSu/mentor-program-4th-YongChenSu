// Method1：盡量不使用內建函式
function capitalize(str) {
  let FirstLetter = ''
  let remainingStr = ''
  if (str.charCodeAt(0) >= 97 &&
    str.charCodeAt(0) <= 122
  ) {
    FirstLetter = String.fromCharCode(str.charCodeAt(0) - 32)
    for (let i = 1; i < str.length; i++) {
      remainingStr += str[i]
    }
    return FirstLetter + remainingStr
  }
  return str
}

console.log(capitalize('hello'));