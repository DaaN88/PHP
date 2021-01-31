### Who_won.php:

Create a function that takes a Tic-tac-toe board and returns "X" if the X's are placed in a way that there are three X's in a row or returns "O" if there is three O's in a row.

Examples:
```php
whoWon([
  ["O", "X", "O"],
  ["X", "X", "O"],
  ["O", "X", "X"]
]) ➞ "X"

whoWon([
  ["O", "O", "X"],
  ["X", "O", "X"],
  ["O", "X", "O"]
]) ➞ "O"

whoWon([
  ["O", "O", "X"],
  ["X", "X", "O"],
  ["O", "X", "O"]
]) ➞ "Tie"
```
Notes
All places on the board will have either "X" or "O".
If both "X" and "O" win, return "Tie".

### freqCount_nested_arrays:

Create a function that takes in a nested array and an element and returns the frequency of that element by nested level.

Examples
```php
freqCount([1, 4, 4, [1, 1, [1, 2, 1, 1]]], 1)
➞ [[0, 1], [1, 2], [2, 3]]
# The array has one 1 at level 0, 2 1's at level 1, and 3 1's at level 2.

freqCount([1, 5, 5, [5, [1, 2, 1, 1], 5, 5], 5, [5]], 5)
➞ [[0, 3], [1, 4], [2, 0]]

freqCount([1, [2], 1, [[2]], 1, [[[2]]], 1, [[[[2]]]]], 2)
➞ [[0, 0], [1, 1], [2, 1], [3, 1], [4, 1]]
```
Notes
Start the default nesting (an array with no nesting) at 0.
Output the nested levels in order (e.g. 0 first, then 1, then 2, etc.).
Output 0 for the frequency if that particular level has no instances of that element (see example #2).