<?php checkAdminLogin();

$document_title = 'Add New Product';

$product_id = '';
$product_name = '';
$fullname = '';
$email = '';
$phone_number = '';
$photo = '';
$status = '';

if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $document_title = 'Edit Product : ' . $product_id;

    $sql = "SELECT * FROM products WHERE product_id='". (int)$product_id ."'";
    $rs = mysqli_query($conn, $sql);

    $data_product = array();
    if(mysqli_num_rows($rs)){
        $data_product = mysqli_fetch_assoc($rs);
        
        $product_name = $data_product['product_name'];
        $fullname = $data_product['fullname'];
        $email = $data_product['email'];
        $phone_number = $data_product['phone_number'];
        $photo = $data_product['photo'];
        $status = $data_product['status'];
        

    }
}

if($_POST){
    $product_name = $_POST['product_name'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];

    
    if(!alreadyExists($product_name, $product_id)){

    if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
        $photo = uploadFile($_FILES['photo'], 'products/');
    }
    
    if(isset($product_id) && !empty($product_id)){
        $sql = "UPDATE products SET product_name='". $product_name ."', fullname='". $fullname ."', email='". $email ."', phone_number='". $phone_number ."', photo='". $photo ."', status='". $status ."' WHERE product_id='". (int)$product_id ."'";
        
        addAlert('success', 'Product has been updated successfully!');
		
    }else{
       $sql = "INSERT INTO products SET product_name='". $product_name ."', fullname='". $fullname ."', email='". $email ."', phone_number='". $phone_number ."', photo='". $photo ."',  status='". $status ."', date_added=NOW()";
       addAlert('success', 'Product has been created successfully!');
    }
    $rs = mysqli_query($conn, $sql);
    
    
    redirect('manage_products.php');

    }else{
        addAlert('danger', 'Product Name already exists!');
    }
}


function alreadyExists($product_name, $product_id){
    global $conn;
    $sql = "SELECT * FROM products WHERE product_name='". $product_name ."' AND product_id!='". $product_id ."'";
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