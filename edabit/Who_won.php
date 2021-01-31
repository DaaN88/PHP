<?php

/*
Create a function that takes a Tic-tac-toe board and returns "X" if the X's are placed in a way that there are three X's in a row or returns "O" if there is three O's in a row.

Examples
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
Notes
All places on the board will have either "X" or "O".
If both "X" and "O" win, return "Tie".
*/

/**
@param array $fields - fields with X and O elements
*/

function whoWon($fields = [])
{
	$positions_X = [];
	$positions_O = [];

	$elements_to_row = array_merge(...$fields);

	foreach ($elements_to_row as $position => $element) {
		if ($element === 'X') {
			$positions_X[] = $position;
		}

		if ($element === 'O') {
			$positions_O[] = $position;
		}
	}

	$winning_combinations_positions = [
		[0, 4, 8],
		[2, 4 ,6],
		[0, 3, 6],
		[1, 4, 7],
		[2, 5, 8],
		[0, 1, 2],
		[3, 4, 5],
		[6, 7, 8]
	];

	$answer = array_reduce($winning_combinations_positions, function ($answer, $positions) use ($positions_O, $positions_X) {
		$quantity_elements_O = array_intersect($positions_O, $positions);
		$quantity_elements_X = array_intersect($positions_X, $positions);

		if (count($quantity_elements_O) === 3) {
			$answer['O'] = 'O';
		}

		if (count($quantity_elements_X) === 3) {
			$answer['X'] = 'X';
		}

		return $answer;
	}, []);

	$is_O = array_key_exists('O', $answer);
	$is_X = array_key_exists('X', $answer);

	if ( ($is_X && $is_O) || !$answer ) {
		return 'Tie';
	}

	if ($is_X) {
		return 'X';
	}

	return 'O';
}

print_r("1: ");
print_r("<br/>");
print_r(whoWon([
            ["X", "O", "X"],
            ["X", "O", "O"],
            ["X", "X", "O"],
        ])); // X
print_r("<br/>");

print_r("2: ");
print_r("<br/>");
print_r(whoWon([
            ["O", "X", "O"],
            ["X", "X", "O"],
            ["O", "X", "X"],
        ])); // X
print_r("<br/>");

print_r("3: ");
print_r("<br/>");
print_r(whoWon([
            ["X", "X", "O"],
            ["O", "X", "O"],
            ["X", "O", "O"],
        ]));
print_r("<br/>"); // O

print_r("4: ");
print_r("<br/>");
print_r(whoWon([
            ["X", "X", "X"],
            ["O", "X", "O"],
            ["X", "O", "O"],
        ]));
print_r("<br/>"); // X

print_r("5: ");
print_r("<br/>");
print_r(whoWon([
            ["X", "O", "X"],
            ["O", "O", "O"],
            ["X", "X", "O"],
        ])); // O
print_r("<br/>");

print_r("6: ");
print_r("<br/>");
print_r(whoWon([
            ["O", "O", "X"],
            ["X", "O", "X"],
            ["O", "X", "O"],
        ])); // O
print_r("<br/>");

print_r("7: ");
print_r("<br/>");
print_r(whoWon([
            ["O", "O", "X"],
            ["O", "X", "X"],
            ["X", "X", "O"],
        ])); // X
print_r("<br/>");

print_r("8: ");
print_r("<br/>");
print_r(whoWon([
            ["O", "O", "X"],
            ["X", "X", "X"],
            ["O", "O", "O"],
        ])); // Tie
print_r("<br/>");

print_r("9: ");
print_r("<br/>");
print_r(whoWon([
            ["O", "O", "X"],
            ["X", "X", "O"],
            ["O", "X", "O"],
        ])); // Tie
print_r("<br/>");
