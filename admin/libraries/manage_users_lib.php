<?php checkAdminLogin();

$document_title = 'Manage Users';
$page_size = 10;
$page = 1;

if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
}


if($_POST){
    
   if(isset($_POST['user_ids']) && !empty($_POST['user_ids'])){
       $user_ids = $_POST['user_ids'];
       foreach($user_ids as $user_id){
            deleteUser($user_id);
       }
       addAlert('success', 'User has been deleted successfully!');
       redirect('manage_users.php');
   }else{
        addAlert('warning', 'Please select atleast 1 user!');
        redirect('manage_users.php');
   }
}

if($_GET){
    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch($action){
            case 'delete':
                
                if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
                    $user_id = $_GET['user_id'];
                    deleteUser($user_id);
                    addAlert('success', 'User has been deleted successfully!');
			        redirect('manage_users.php');
                }else{
                    addAlert('warning', 'User id not defined!');
                    redirect('manage_users.php');
                }

            break;
        }
    }
}

$sql_total = "SELECT COUNT(*) as total FROM users";
$rs_total = mysqli_query($conn, $sql_total);
$user_total = mysqli_fetch_assoc($rs_total)['total'];

$cur_page = ( $page - 1 ) * $page_size;
$sql = "SELECT * FROM users LIMIT ". $cur_page .", " . $page_size;
$rs = mysqli_query($conn, $sql);

$data_users = array();
if(mysqli_num_rows($rs)){
    while($rec = mysqli_fetch_assoc($rs)){
        $data_users[] = $rec;
    }
}

function deleteUser($user_id){
    if($_SESSION['admin_user']['user_id'] == $user_id){
        addAlert('warning', 'Logged in user can\'t be deleted!');
        redirect('manage_users.php');
        return false;
    }
    global $conn;
    $sql_del = "DELETE FROM users WHERE user_id='". (int)$user_id ."'";
    mysqli_query($conn, $sql_del);
}