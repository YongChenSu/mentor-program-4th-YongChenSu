var readline = require('readline');

var lines = []
var rl = readline.createInterface({
  input: process.stdin
});

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function () {
  solve(lines)
})

function solve(lines) {
  let line1 = lines[0].split(' ')
  let arrLength = Number(line1[0])
  let targetBeginIndex = arrLength + 1
  let targetAmount = Number(line1[1])
  let arr = []
  for (let i = 1; i <= arrLength; i++) {
    arr.push(lines[i])
  }

  for (let j = targetBeginIndex; j < targetBeginIndex + targetAmount; j++) {
    console.log(binarySearch(arr, Number(lines[j])))
  }
}

function binarySearch(arr, target) {
  let L = 0
  let R = arr.length - 1
  while (L <= R) {
    let M = Math.floor((L + R) / 2)
    if (arr[M] == target) {
      return M
    } else if (arr[M] > target) {
      R = M - 1
    } else {
      L = M + 1
    }
  }
  return -1
}