const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', line => lines.push(line));

function printStar(n) {
  let star = '';
  for (let j = 0; j < n; j + 1) {
    star += '*';
    console.log(star);
  }
}

function solve(input) {
  const N = Number(input[0]);
  printStar(N);
}

rl.on('close', () => {
  solve(lines);
});
