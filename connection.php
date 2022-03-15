<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'training_dec_2021');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conn){
    echo 'Error: Database connection failed!';
}

$sql = "SELECT * FROM users";

$rs = mysqli_query($conn, $sql);
// echo '<pre>';
$data_users = array();
if(mysqli_num_rows($rs)){
    // while($rec = mysqli_fetch_object($rs)){
        // while($rec = mysqli_fetch_array($rs)){
        // while($rec = mysqli_fetch_row($rs)){
    while($rec = mysqli_fetch_assoc($rs)){
        $data_users[] = $rec;
    }
}else{
    echo 'No record found!';
}

// print_r($data_users);
// die;

?>


<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>UserID</th>
        <th>Username</th>
        <th>Fullname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date Added</th>
        <th>Action</th>
    </tr>

    <?php if(sizeof($data_users)){ ?>
        <?php foreach($data_users as $data_user){ ?>
            <tr>
                <td><?php echo $data_user['user_id']; ?></td>
                <td><?php echo $data_user['username']; ?></td>
                <td><?php echo $data_user['fullname']; ?></td>
                <td><?php echo $data_user['email']; ?></td>
                <td><?php echo $data_user['phone_number']; ?></td>
                <td><?php echo $data_user['date_added']; ?></td>
                <td>Edit | Delete</td>
            </tr>
        <?php } ?>
    <?php } ?>
</table>
