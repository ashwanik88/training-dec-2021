<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

echo '<pre>';

// $input_array = array("FirSt" => 1, "SecOnd" => 4);
// print_r(array_change_key_case($input_array, CASE_UPPER));

// $input_array = array('a', 'b', 'c', 'd', 'e');

// print_r($input_array);

// print_r(array_chunk($input_array, 2));
// print_r(array_chunk($input_array, 2, true));

// $a = array('green', 'red', 'yellow');
// $b = array('avocado', 'apple', 'banana');
// $c = array_combine($b, $a);

// print_r($c);

// $array = array(1, "hello", 1, "world", "hello");
// print_r(array_count_values($array));

// $array1 = array("a" => "green", "red", "blue", "red");
// $array2 = array("b" => "green", "yellow", "red");
// $result = array_diff($array1, $array2);

// print_r($result);

// function odd($var)
// {
//     // returns whether the input integer is odd
//     return $var & 1;
// }

// function even($var)
// {
//     // returns whether the input integer is even
//     return !($var & 1);
// }

// $array1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
// $array2 = [6, 7, 8, 9, 10, 11, 12];

// echo "Odd :\n";
// print_r(array_filter($array1, "odd"));
// echo "Even:\n";
// print_r(array_filter($array2, "odd"));

// $input = array("oranges", "apples", "pears");
// $flipped = array_flip($input);

// print_r($flipped);


// $array1 = array("a" => "green", "red", "blue");
// $array2 = array("b" => "green", "yellow", "red");
// $result = array_intersect($array1, $array2);
// print_r($result);


// $search_array = array('first' => null, 'second' => 4);

// // returns false
// $response = isset($search_array['first']);  // null = 0 = '' = false
// var_dump( $response );
// // returns true
// $response = array_key_exists('first', $search_array);
// var_dump( $response );

// $array = array(0 => 100, "color" => "red");
// print_r(array_keys($array));

// function cube($n)
// {
//     return ($n * $n * $n);
// }

// $a = [1, 2, 3, 4, 5];
// $b = array_map('cube', $a);
// print_r($b);


// $array1 = array("color" => "red", 2, 4);
// $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
// $result = array_merge($array1, $array2);
// print_r($result);

// task find prime number from array using array_filter function
// quiz
// combo box

// $stack = array("orange", "banana");
// array_push($stack, "apple", "raspberry");
// print_r($stack);

// array_pop($stack);

// print_r($stack);

// array_unshift($stack, "Kiwi");
// array_unshift($stack, "Mango");

// print_r($stack);

// array_shift($stack);
// array_shift($stack);

// print_r($stack);

// echo rand(1000, 9999);

// $input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
// $rand_keys = array_rand($input, 2);

// print_r($rand_keys);

// echo $input[$rand_keys[0]];
// echo '<br>';
// echo $input[$rand_keys[1]];

// $base = array("orange", "banana", "apple", "raspberry");
// $replacements = array(0 => "pineapple", 4 => "cherry");
// $replacements2 = array(0 => "grape");

// $basket = array_replace($base, $replacements, $replacements2);
// print_r($base);
// print_r($replacements);
// print_r($replacements2);
// print_r($basket);

// $str = 'Hello World';
// $search = array('or', 'o');
// $replace = array('k', 'and');
// echo str_replace($search, $replace, $str);

// $input  = array("php", 4.0, array("green", "red"));
// $reversed = array_reverse($input);
// $preserved = array_reverse($input, true);

// print_r($input);
// print_r($reversed);
// print_r($preserved);

// $array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');

// echo $key = array_search('green', $array); // $key = 2;
// echo '<br>';
// echo $key = array_search('red', $array);   // $key = 1;

// $input = array("a", "b", "c", "d", "e");

// $output = array_slice($input, 2);      // returns "c", "d", and "e"
// $output = array_slice($input, -2, 1);  // returns "d"
// $output = array_slice($input, 0, 3);   // returns "a", "b", and "c"

// // note the differences in the array keys
// print_r(array_slice($input, 2, -1));
// print_r(array_slice($input, 2, -1, true));

// $a = array(2, 4, 6, 8);
// echo "sum(a) = " . array_sum($a) . "\n";

// $input = array("a" => "green", "red", "b" => "green", "blue", "red");
// $result = array_unique($input);
// print_r($result);

$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
asort($fruits);
foreach ($fruits as $key => $val) {
    echo "$key = $val\n";
}