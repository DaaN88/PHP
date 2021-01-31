Who_won.php:

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
