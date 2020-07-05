/* eslint-disable */
// The homework5 solved by using "BigInt()".
const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));
function solve(lines) {
  const arrLength = Number(lines[0])
  for (let i = 1; i <= arrLength; i++) {
    const [a, b, k] = lines[i].split(' ')
    if (k == 1) {
      if (BigInt(a) > BigInt(b)) {
        console.log('A')
      } else if (BigInt(a) === BigInt(b)) {
        console.log('DRAW')
      } else {
        console.log('B')
      }
    } else {
      if (BigInt(a) > BigInt(b)) {
        console.log('B')
      } else if (BigInt(a) === BigInt(b)) {
        console.log('DRAW')
      } else {
        console.log('A')
      }
    }
  }
}

rl.on('close', () => solve(lines))
