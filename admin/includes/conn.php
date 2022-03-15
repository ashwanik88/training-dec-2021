<?php 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conn){
    echo 'Error: Database connection failed!';
}