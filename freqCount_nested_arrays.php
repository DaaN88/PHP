<?php

/*
Create a function that takes in a nested array and an element and returns the frequency of that element by nested level.

Examples
freqCount([1, 4, 4, [1, 1, [1, 2, 1, 1]]], 1)
➞ [[0, 1], [1, 2], [2, 3]]
# The array has one 1 at level 0, 2 1's at level 1, and 3 1's at level 2.

freqCount([1, 5, 5, [5, [1, 2, 1, 1], 5, 5], 5, [5]], 5)
➞ [[0, 3], [1, 4], [2, 0]]

freqCount([1, [2], 1, [[2]], 1, [[[2]]], 1, [[[[2]]]]], 2)
➞ [[0, 0], [1, 1], [2, 1], [3, 1], [4, 1]]
Notes
Start the default nesting (an array with no nesting) at 0.
Output the nested levels in order (e.g. 0 first, then 1, then 2, etc.).
Output 0 for the frequency if that particular level has no instances of that element (see example #2).
*/

function freqCount($elements, $search_element)
{
	$flatted_elements = flatten($elements, $search_element);

	return counted($flatted_elements);
}


function flatten($array, $search_element, $nested_level = 0)
{
    $result = [];
    $counter = '';

    return array_reduce($array, function($result, $value) use ($search_element, $nested_level) {
    	if (is_array($value)) {
        	$nested_level++;

            $result = array_merge($result, flatten($value, $search_element, $nested_level));
            
            $nested_level--;
        } else {
        	($value === $search_element) ? $counter = 1 : $counter = 0;

            $result[] = ["level" => $nested_level, "val" => $value, "count" => $counter];
        }

        return $result;
    }, []);
}


function counted($values)
{
	$check_array = get_check_array($values);

	$quantity_searched_elements = count_searched_elements($values);

	$result = added_missing_levels($check_array, $quantity_searched_elements);

	$final_result = [];
	foreach ($result as $key => $value) {
		$final_result[] = [$value['level'], $value['count']];
	}
	
	return $final_result;
}

function get_max_level($array)
{
	sort($array);

	$last_element = count($array) - 1;
	
	return $array[$last_element]['level'];
}

function get_check_array($array)
{
	$max_level = get_max_level($array);
	$min_level = 0;

	$levels = range($min_level, $max_level);

	$result = [];

	foreach ($levels as $key => $value) {
		$result[] = ['level' => $key, 'count' => 0];
	}

	return $result;
}

function count_searched_elements($array)
{
	$searched_elements = array_filter($array, function($value) {
		return $value['count'] === 1;
	});
	
	sort($searched_elements);

	$elements_levels = [];
	foreach ($searched_elements as $element) {
		$elements_levels[] = $element['level'];
	}

	$answer = array_count_values($elements_levels);

	$results = [];
	foreach ($answer as $level => $quantity) {
		$results[] = ['level' => $level, 'count' => $quantity];
	}

	sort($results);

	return $results;
}

function added_missing_levels($check_array, $checked_array)
{
	$results = $checked_array;

	$buffer_for_check = [];
	$buffer_for_checked = [];

	foreach ($checked_array as $key => $value) {
		$buffer_for_checked[] = $value['level'];
	}

	foreach ($check_array as $key => $value) {
		$buffer_for_check[] = $value['level'];
	}

	$missing_levels = array_values(array_diff($buffer_for_check, $buffer_for_checked));

	foreach ($missing_levels as $key => $value) {
		$results[] = ['level' => $value, 'count' => 0];
	}

	usort($results, function($val_one, $val_two) {
		if ($val_one['level'] == $val_two['level']) {
        	return 0;
    	}

    	return ($val_one['level'] < $val_two['level']) ? -1 : 1;
	});

	return $results;
}

print_r(freqCount([1, [1], 4, [1, 1, [1, 2, [1], 1]]], 1)); // ➞ [[0, 1], [1, 2], [2, 3]]
print_r("<br/>");
print_r(freqCount([1, 1, 1, 1], 1));
print_r("<br/>");
print_r(freqCount([1, 1, 2, 2], 1));
print_r("<br/>");
print_r(freqCount([1, 1, 2, [1]], 1));
print_r("<br/>");
print_r(
	freqCount(
		[ 
			1,
			1,
			2,
			[
				[
					1
				],
			]
		], 
		1
	)
); // [[0, 2], [1, 0], [2, 1]]
print_r("<br/>");
print_r(freqCount([1, 5, 5, [5, [1, 2, 1, 1], 5, 5], 5, [5]], 5));
print_r("<br/>");
print_r(freqCount([1, [2], 1, [[2]], 1, [[[2]]], 1, [[[[2]]]]], 2)); // [[0, 0], [1, 1], [2, 1], [3, 1], [4, 1]]
print_r("<br/>");
print_r(freqCount([[[1]]], 1)); // [[0, 0], [1, 0], [2, 1]]
print_r("<br/>");

/*
0: [1, 4]
1: [1], [1, 1]
2: [1, 2, 1]
3: [1]
*/