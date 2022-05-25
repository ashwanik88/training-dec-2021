<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

$a = '';
$b = '';
$c = '';
if($_POST){
    $a = $_POST['txt1'];
    $b = $_POST['txt2'];
    if($_POST['btn'] == '+'){
        $c = $a + $b;
    }
    if($_POST['btn'] == '-'){
        $c = $a - $b;
    }
    if($_POST['btn'] == '*'){
        $c = $a * $b;
    }
    $arr = array('total' => $c);
    echo json_encode($arr);
    die;
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

<form method="POST" action="" id="frm">
<table border="1" cellpadding="10" cellspacing="0">
    <tr><th colspan="2">Add Two Numbers</th></tr>
    <tr><td>Enter First Number: </td><td><input type="text" id="txt1" name="txt1" value="<?php echo $a; ?>" class="required digits" /></td></tr>
    <tr><td>Enter Second Number: </td><td><input type="text" id="txt2" name="txt2" value="<?php echo $b; ?>" class="required digits" /></td></tr>
    <tr><td>Result: </td><td class="total"><?php echo $c; ?></td></tr>
    <tr><td></td><td>
        <input type="submit" value="+" name="btn" /> 
        <input type="submit" value="-" name="btn" />
        <input type="submit" value="*" name="btn" />
    </td></tr>
</table>
</form>

<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/validation/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#frm').validate({
    submitHandler: function(form){
            $('input[name="btn"]').click(function(){
            var btn = $(this).val();
            $.ajax({
                url: 'add_numbers_ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    'txt1' : $('#txt1').val(),
                    'txt2' : $('#txt2').val(),
                    'btn'  : btn,
                },
                success: function(json){
                    $('.total').html(json.total);
                }
            });

            return false;
        });
    }
});


</script>
</body>
</html>