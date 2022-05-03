<?php checkAdminLogin();

$document_title = 'Manage Categories';
$page_size = 10;
$page = 1;
$sort_by = 'category_id';
$sort_order = 'DESC';
$filter_url = '';
$filter = ' WHERE 1=1 '; // 1=1 means true
$filter_category_id = '';
$filter_category_name = '';
$filter_parent_id = '';
$filter_status = '';
$filter_date_added = '';
$filter_category_id = '';


$filter .= " AND parent_id = '0'";

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

if(isset($_GET['filter_category_id']) && !empty($_GET['filter_category_id'])){
    $filter_category_id = $_GET['filter_category_id'];
    $filter .= " AND category_id = '". (int)$filter_category_id ."'";
    $filter_url .= '&filter_category_id=' . $filter_category_id;
}
if(isset($_GET['filter_category_name']) && !empty($_GET['filter_category_name'])){
    $filter_category_name = $_GET['filter_category_name'];
    $filter .= " AND category_name LIKE '%". $filter_category_name ."%'";
    $filter_url .= '&filter_category_name=' . $filter_category_name;
}
if(isset($_GET['filter_parent_id']) && !empty($_GET['filter_parent_id'])){
    $filter_parent_id = $_GET['filter_parent_id'];
    $filter .= " AND parent_id LIKE '%". $filter_parent_id ."%'";
    $filter_url .= '&filter_parent_id=' . $filter_parent_id;
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
    
   if(isset($_POST['category_ids']) && !empty($_POST['category_ids'])){
       $category_ids = $_POST['category_ids'];
       foreach($category_ids as $category_id){
            deleteCategory($category_id);
       }
       addAlert('success', 'Category has been deleted successfully!');
       redirect('manage_categories.php');
   }else{
        addAlert('warning', 'Please select atleast 1 category!');
        redirect('manage_categories.php');
   }
}

if($_GET){
    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action = $_GET['action'];
        switch($action){
            case 'delete':
                
                if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
                    $category_id = $_GET['category_id'];
                    deleteCategory($category_id);
                    addAlert('success', 'Category has been deleted successfully!');

			        redirect('manage_categories.php');
                }else{
                    addAlert('warning', 'Category id not defined!');
                    redirect('manage_categories.php');
                }

            break;
        }
    }
}

$sql_total = "SELECT COUNT(*) as total FROM categories" . $filter;
$rs_total = mysqli_query($conn, $sql_total);
$category_total = mysqli_fetch_assoc($rs_total)['total'];

$cur_page = ( $page - 1 ) * $page_size;
$sql = "SELECT * FROM categories ". $filter ." ORDER BY ". $sort_by ." ". $sort_order ." LIMIT ". $cur_page .", " . $page_size;
$rs = mysqli_query($conn, $sql);

$data_categories = array();
if(mysqli_num_rows($rs)){
    while($rec = mysqli_fetch_assoc($rs)){
        $data_categories[] = $rec;
    }
}

$sort_order = ($sort_order == 'ASC')?'DESC':'ASC';// swapping

function deleteCategory($category_id){
    if($_SESSION['admin_category']['category_id'] == $category_id){
        addAlert('warning', 'Logged in category can\'t be deleted!');
        redirect('manage_categories.php');
        return false;
    }
    global $conn;
    $sql_del = "DELETE FROM categories WHERE category_id='". (int)$category_id ."'";
    mysqli_query($conn, $sql_del);
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

function displayCategories($category_id, $parent_id = 0, $sep = ''){
    $categories = getCategories($category_id);
    $html = '';
    if(sizeof($categories)){
        foreach($categories as $category){
            if($category['parent_id'] == 0){
                $sep = '';
            }
            

            $html .= '<tr>
            <td><input type="checkbox" class="chk" name="category_ids[]" value="'.$category['category_id'].'" /> </td>
            <td>'.$category['category_id'].'</td>
            <td>'.$category['category_name'] . $sep .'</td>
            <td>'.$category['parent_id'].'</td>
            <td>'.(($category['status'] == 1)?'Active':'Inactive').'</td>
            <td>'.$category['date_added'].'</td>
            <td><a href="form_category.php?category_id='.$category['category_id'].'"> Edit </a> | <a href="manage_categories.php?action=delete&category_id='.$category['category_id'].'" onclick="return confirm(\'Are you sure want to delete this?\');">Delete</a></td>
          </tr>';


            // $sep = $sep . '----';
            $sep .= ' >> ';
            $html .= displayCategories($category['category_id'], $parent_id , $sep); // recursion
        } 
    }
    return $html;
}
