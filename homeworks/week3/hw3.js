/* eslint-disable */
const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));
function isPrime(n) {
  if (n === 1) return false
  for (let i = 2; i < n; i++) {
    if (n % i === 0) {
      return false
    }
  }
  return true
}
function solve(lines) {
  for (let i = 1; i <= Number(lines[0]); i++) {
    if (isPrime(Number(lines[i]))) {
      console.log('Prime')
    } else {
      console.log('Composite')
    }
  }
}

rl.on('close', () => solve(lines))
