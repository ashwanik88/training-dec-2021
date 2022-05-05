HTML
<?php
    ini_set('display_errors', true);
    error_reporting(E_ALL);

    $a = 4;
    $b = 5;

    $c = $a + $b;

    echo $c;

    $arr = array(
        'key1' => 'hello',
        'key2' => 'world',
    );
    echo '<pre>';
    print_r($arr);
    

?>
HTML