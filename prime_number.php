<?php

for($n = 2; $n <= 100; $n++){
//	$n = 97;

//print_prime($n);


}


$arr = array(23,17,25,23,45,76,12,79,54);

// foreach($arr as $n){
	// echo $n . '<br>';
	// print_prime($n);
// }

array_filter($arr, 'print_prime');

function print_prime($n){
	$flag = true;
	for($i = 2; $i < $n; $i++){
		if($n % $i == 0){
			$flag = false;
		}
	}

	if($flag){
		echo $n . ' is a prime number!' . '<br>'; 
	}else{
		// echo $n . ' is not a prime number!'; 
	}
}