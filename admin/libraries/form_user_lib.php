<?php checkAdminLogin();

$document_title = 'Add New User';

if($_POST){
    echo '<pre>';
    print_r($_POST);
    die;
}
