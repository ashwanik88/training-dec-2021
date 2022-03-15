<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
$a = '';
$b = '';
$c = '';

// $_REQUEST = $_POST || $_GET
if($_GET){

    $a = $_GET['txt1'];
    $b = $_GET['txt2'];
    if($_GET['btn'] == '+'){
        $c = $a + $b;
    }
    if($_GET['btn'] == '-'){
        $c = $a - $b;
    }
    if($_GET['btn'] == '*'){
        $c = $a * $b;
    }
}

// $n = 0;
// while($n <= 10){
//     echo $n . '<br>';
//     $n++;
// }

/*
1) simple interest
2) prime number
3) electricity bill
4) marksheet
*/
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        Add Two Numbers - JavaScript
    </title>
</head>
<body>

<form method="GET" action="">
<table border="1" cellpadding="10" cellspacing="0">
    <tr><th colspan="2">Add Two Numbers</th></tr>
    <tr><td>Enter First Number: </td><td><input type="text" name="txt1" value="<?php echo $a; ?>" /></td></tr>
    <tr><td>Enter Second Number: </td><td><input type="text" name="txt2" value="<?php echo $b; ?>" /></td></tr>
    <tr><td>Result: </td><td><?php echo $c; ?></td></tr>
    <tr><td></td><td>
        <input type="submit" value="+" name="btn" /> 
        <input type="submit" value="-" name="btn" />
        <input type="submit" value="*" name="btn" />
    </td></tr>
</table>
</form>
</body>
</html>