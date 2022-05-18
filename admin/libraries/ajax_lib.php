<?php checkAdminLogin();

$arr = array('success' => false, 'msg' => 'Incomplete form data!');

if(isset($_POST['username']) && !empty($_POST['username'])){
    $username = $_POST['username'];
    $user_id = $_POST['user_id'];
    $resp = alreadyExists($username, $user_id);
    if($resp){
        $arr['success'] = false;
        $arr['msg'] = 'Username not available!';
    }else{
        $arr['success'] = true;
        $arr['msg'] = 'Username available!';
    }
}

echo json_encode($arr);
die;

function alreadyExists($username, $user_id){
    global $conn;
    $sql = "SELECT * FROM users WHERE username='". $username ."' AND user_id!='". $user_id ."'";
    $rs = mysqli_query($conn, $sql);

    if(mysqli_num_rows($rs)){
        return true;
    }

    return false;
}

