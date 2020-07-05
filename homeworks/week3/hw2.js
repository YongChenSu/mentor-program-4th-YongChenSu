/* eslint-disable */
const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));
function solve(lines) {
  function digitsCount(number) {
    if (number === 0) return 1
    let result = 0
    while (number !== 0) {
      number = Math.floor(number / 10)
      result++
    }
    return result
  }
  function isNarcissistic(number) {
    // 幾位數
    let copyNum = number
    const digits = digitsCount(copyNum)
    let sum = 0
    while (copyNum !== 0) {
      const num = copyNum % 10
      sum += num ** digits
      copyNum = Math.floor(copyNum / 10)
    }
    if (sum === number) {
      return true
    }
    return false
  }
  const temp = lines[0].split(' ')
  const beginNumber = Number(temp[0])
  const endNumber = Number(temp[1])
  for (let i = beginNumber; i <= endNumber; i++) {
    if (isNarcissistic(i)) {
      console.log(i)
    }
  }
}

rl.on('close', () => solve(lines))
