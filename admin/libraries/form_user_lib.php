<?php checkAdminLogin();

$document_title = 'Add New User';

$user_id = '';
$username = '';
$fullname = '';
$email = '';
$phone_number = '';
$photo = '';
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
        $photo = $data_user['photo'];
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

    // copy();

    // print_r($_FILES['photo']);
    

    if($password == $cpassword){
    
    if(!alreadyExists($username, $user_id)){

    if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
        $photo = uploadFile($_FILES['photo'], 'users/');
    }
    
    if(isset($user_id) && !empty($user_id)){
        $sql = "UPDATE users SET username='". $username ."', fullname='". $fullname ."', email='". $email ."', phone_number='". $phone_number ."', photo='". $photo ."', status='". $status ."' WHERE user_id='". (int)$user_id ."'";
        
        addAlert('success', 'User has been updated successfully!');

        if(!empty($password)){
            $sql_pass = "UPDATE users SET password='". md5($password) ."' WHERE user_id='". (int)$user_id ."'";
            mysqli_query($conn, $sql_pass);
        }

        
        

    }else{
       $sql = "INSERT INTO users SET username='". $username ."', fullname='". $fullname ."', password='". md5($password) ."', email='". $email ."', phone_number='". $phone_number ."', photo='". $photo ."',  status='". $status ."', date_added=NOW()";
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

function uploadFile($file, $path){
    $tmp_name = $file['tmp_name'];
    $name = $file['name'];
    $sub_dir = $path;
    $new_filename = time() . '-' . $name;
    $dir = DIR_UPLOADS . $sub_dir;
    if(!is_dir($dir)){
        mkdir($dir, '0777');
    }

    $dest = $dir .  $new_filename;
    
    $ok = move_uploaded_file($tmp_name, $dest);
    
    if($ok){
        return $sub_dir .  $new_filename;
    }
    return '';
}