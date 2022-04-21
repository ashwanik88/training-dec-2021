<?php checkAdminLogin();

$document_title = 'Manage Users';
$page_size = 10;
$page = 1;
$sort_by = 'user_id';
$sort_order = 'DESC';
$filter_url = '';
$filter = ' WHERE 1=1 '; // 1=1 means true
$filter_user_id = '';
$filter_username = '';
$filter_fullname = '';
$filter_email = '';
$filter_phone = '';
$filter_status = '';
$filter_date_added = '';
$filter_user_id = '';

if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
    $sort_by = $_GET['sort_by'];
    $filter_url .= '&sort_by=' . $sort_by;
}

if(isset($_GET['sort_order']) && !empty($_GET['sort_order'])){
    $sort_order = $_GET['sort_order'];
    $filter_url .= '&sort_order=' . $sort_order;
}

if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
}

if(isset($_GET['filter_user_id']) && !empty($_GET['filter_user_id'])){
    $filter_user_id = $_GET['filter_user_id'];
    $filter .= " AND user_id = '". (int)$filter_user_id ."'";
    $filter_url .= '&filter_user_id=' . $filter_user_id;
}
if(isset($_GET['filter_username']) && !empty($_GET['filter_username'])){
    $filter_username = $_GET['filter_username'];
    $filter .= " AND username LIKE '%". $filter_username ."%'";
    $filter_url .= '&filter_username=' . $filter_username;
}
if(isset($_GET['filter_fullname']) && !empty($_GET['filter_fullname'])){
    $filter_fullname = $_GET['filter_fullname'];
    $filter .= " AND fullname LIKE '%". $filter_fullname ."%'";
    $filter_url .= '&filter_fullname=' . $filter_fullname;
}
if(isset($_GET['filter_email']) && !empty($_GET['filter_email'])){
    $filter_email = $_GET['filter_email'];
    $filter .= " AND email LIKE '%". $filter_email ."%'";
    $filter_url .= '&filter_email=' . $filter_email;
}
if(isset($_GET['filter_phone']) && !empty($_GET['filter_phone'])){
    $filter_phone = $_GET['filter_phone'];
    $filter .= " AND phone_number LIKE '%". $filter_phone ."%'";
    $filter_url .= '&filter_phone=' . $filter_phone;
}
if(isset($_GET['filter_status'])){
    $filter_status = $_GET['filter_status'];
    $filter .= " AND status = '". $filter_status ."'";
    $filter_url .= '&filter_status=' . $filter_status;
}
if(isset($_GET['filter_date_added']) && !empty($_GET['filter_date_added'])){
    $filter_date_added = $_GET['filter_date_added'];
    $filter .= " AND date_added = '". $filter_date_added ."'";
    $filter_url .= '&filter_date_added=' . $filter_date_added;
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

$sql_total = "SELECT COUNT(*) as total FROM users" . $filter;
$rs_total = mysqli_query($conn, $sql_total);
$user_total = mysqli_fetch_assoc($rs_total)['total'];

$cur_page = ( $page - 1 ) * $page_size;
$sql = "SELECT * FROM users ". $filter ." ORDER BY ". $sort_by ." ". $sort_order ." LIMIT ". $cur_page .", " . $page_size;
$rs = mysqli_query($conn, $sql);

$data_users = array();
if(mysqli_num_rows($rs)){
    while($rec = mysqli_fetch_assoc($rs)){
        $data_users[] = $rec;
    }
}

$sort_order = ($sort_order == 'ASC')?'DESC':'ASC';// swapping

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


