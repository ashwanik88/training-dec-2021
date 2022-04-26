<?php checkAdminLogin();

$document_title = 'Add New Category';

$category_id = '';
$category_name = '';
$parent_id = '';
$status = '';

$data_categories = getCategories();

if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $document_title = 'Edit Category : ' . $category_id;

    $sql = "SELECT * FROM categories WHERE category_id='". (int)$category_id ."'";
    $rs = mysqli_query($conn, $sql);

    $data_category = array();
    if(mysqli_num_rows($rs)){
        $data_category = mysqli_fetch_assoc($rs);
        
        $category_name = $data_category['category_name'];
        $parent_id = $data_category['parent_id'];
        $status = $data_category['status'];
        

    }
}

if($_POST){
    $category_name = $_POST['category_name'];
    $parent_id = $_POST['parent_id'];
    $status = $_POST['status'];

    if($password == $cpassword){
    
    if(isset($category_id) && !empty($category_id)){
        $sql = "UPDATE categories SET category_name='". $category_name ."', parent_id='". $parent_id ."', status='". $status ."' WHERE category_id='". (int)$category_id ."'";
        addAlert('success', 'Category has been updated successfully!');

    }else{
       $sql = "INSERT INTO categories SET category_name='". $category_name ."', parent_id='". $parent_id ."', status='". $status ."', date_added=NOW()";
       addAlert('success', 'Category has been created successfully!');
    }
    $rs = mysqli_query($conn, $sql);
    
    
    redirect('manage_categories.php');


}else{
    addAlert('danger', 'Confirm password not matched!');
}
}

function getCategories($parent_id = 0){
    global $conn;
    $sql = "SELECT * FROM categories WHERE parent_id='". (int)$parent_id ."'";
    $rs = mysqli_query($conn, $sql);
    $data = array();
    if(mysqli_num_rows($rs)){
        while($rec = mysqli_fetch_assoc($rs)){
            $data[] = $rec;
        }
    }
    return $data;
}