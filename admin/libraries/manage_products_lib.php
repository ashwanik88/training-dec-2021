<?php checkAdminLogin();

$document_title = 'Manage Products';
$page_size = 10;
$page = 1;
$sort_by = 'product_id';
$sort_order = 'DESC';
$filter_url = '';
$filter = ' WHERE 1=1 '; // 1=1 means true
$filter_product_id = '';
$filter_product_name = '';
$filter_fullname = '';
$filter_email = '';
$filter_phone = '';
$filter_status = '';
$filter_date_added = '';
$filter_product_id = '';

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

if(isset($_GET['filter_product_id']) && !empty($_GET['filter_product_id'])){
    $filter_product_id = $_GET['filter_product_id'];
    $filter .= " AND product_id = '". (int)$filter_product_id ."'";
    $filter_url .= '&filter_product_id=' . $filter_product_id;
}
if(isset($_GET['filter_product_name']) && !empty($_GET['filter_product_name'])){
    $filter_product_name = $_GET['filter_product_name'];
    $filter .= " AND product_name LIKE '%". $filter_product_name ."%'";
    $filter_url .= '&filter_product_name=' . $filter_product_name;
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
    
   if(isset($_POST['product_ids']) && !empty($_POST['product_ids'])){
       $product_ids = $_POST['product_ids'];
       foreach($product_ids as $product_id){
            deleteProduct($product_id);
       }
       addAlert('success', 'Product has been deleted successfully!');
       redirect('manage_products.php');
   }else{
        addAlert('warning', 'Please select atleast 1 product!');
        redirect('manage_products.php');
   }
}

if($_GET){
    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch($action){
            case 'delete':
                
                if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
                    $product_id = $_GET['product_id'];
                    deleteProduct($product_id);
                    addAlert('success', 'Product has been deleted successfully!');

			        redirect('manage_products.php');
                }else{
                    addAlert('warning', 'Product id not defined!');
                    redirect('manage_products.php');
                }

            break;
        }
    }
}

$sql_total = "SELECT COUNT(*) as total FROM products" . $filter;
$rs_total = mysqli_query($conn, $sql_total);
$product_total = mysqli_fetch_assoc($rs_total)['total'];

$cur_page = ( $page - 1 ) * $page_size;
$sql = "SELECT * FROM products ". $filter ." ORDER BY ". $sort_by ." ". $sort_order ." LIMIT ". $cur_page .", " . $page_size;
$rs = mysqli_query($conn, $sql);

$data_products = array();
if(mysqli_num_rows($rs)){
    while($rec = mysqli_fetch_assoc($rs)){
        $data_products[] = $rec;
    }
}

$sort_order = ($sort_order == 'ASC')?'DESC':'ASC';// swapping

function deleteProduct($product_id){
    if($_SESSION['admin_product']['product_id'] == $product_id){
        addAlert('warning', 'Logged in product can\'t be deleted!');
        redirect('manage_products.php');
        return false;
    }
    global $conn;
    $sql_del = "DELETE FROM products WHERE product_id='". (int)$product_id ."'";
    mysqli_query($conn, $sql_del);
}


