function join(arr, separator) {
  let temp = ''
  if (arr.length === 1) {
    temp = arr[0] + separator
  } else {
    for (let i = 0; i < arr.length; i++) {
      if (i === arr.length - 1) {
        temp += arr[i]
      } else {
        temp += arr[i] + separator
      }
    }
  }
  return temp
}
function repeat(str, times) {
  let result = ''
  for (let i = 1; i <= times; i++) {
    result += str
  }
  return result
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
