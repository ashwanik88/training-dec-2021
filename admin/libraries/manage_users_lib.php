<?php checkAdminLogin();

$document_title = 'Manage Users';

$sql = "SELECT * FROM users";
$rs = mysqli_query($conn, $sql);

$data_users = array();
if(mysqli_num_rows($rs)){
    while($rec = mysqli_fetch_assoc($rs)){
        $data_users[] = $rec;
    }
}