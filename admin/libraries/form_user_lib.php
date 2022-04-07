<?php checkAdminLogin();

$document_title = 'Add New User';

$user_id = '';
$username = '';
$fullname = '';
$email = '';
$phone_number = '';
$status = '';

if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $document_title = 'Edit User : ' . $user_id;

    $sql = "SELECT * FROM users WHERE user_id='". (int)$user_id ."'";
    $rs = mysqli_query($conn, $sql);

    $data_user = array();
    if(mysqli_num_rows($rs)){
        $data_user = mysqli_fetch_assoc($rs);
        
        $username = $data_user['username'];
        $fullname = $data_user['fullname'];
        $email = $data_user['email'];
        $phone_number = $data_user['phone_number'];
        $status = $data_user['status'];
        

    }
}

if($_POST){
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];

    if($password == $cpassword){
    
    if(!alreadyExists($username, $user_id)){
    if(isset($user_id) && !empty($user_id)){
        $sql = "UPDATE users SET username='". $username ."', fullname='". $fullname ."', password='". md5($password) ."', email='". $email ."', phone_number='". $phone_number ."', status='". $status ."' WHERE user_id='". (int)$user_id ."'";
        addAlert('success', 'User has been updated successfully!');
    }else{
       $sql = "INSERT INTO users SET username='". $username ."', fullname='". $fullname ."', password='". md5($password) ."', email='". $email ."', phone_number='". $phone_number ."', status='". $status ."', date_added=NOW()";
       addAlert('success', 'User has been created successfully!');
    }
    $rs = mysqli_query($conn, $sql);
    
    
    redirect('manage_users.php');

    }else{
        addAlert('danger', 'Username already exists!');
    }

}else{
    addAlert('danger', 'Confirm password not matched!');
}
}


function alreadyExists($username, $user_id){
    global $conn;
    $sql = "SELECT * FROM users WHERE username='". $username ."' AND user_id!='". $user_id ."'";
    $rs = mysqli_query($conn, $sql);

    if(mysqli_num_rows($rs)){
        return true;
    }

    return false;
}