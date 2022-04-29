<?php 

if(isset($_COOKIE['username']) && !empty($_COOKIE['username']) && isset($_COOKIE['password']) && !empty($_COOKIE['password'])){
	$username = $_COOKIE['username'];
	$md5_password = $_COOKIE['password'];
	checkUserLogin($username, $md5_password);
}

if($_POST){
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		checkUserLogin($username, $password);

	}
}

function checkUserLogin($username, $md5_password){
	global $conn;
	$sql = "SELECT * FROM users WHERE username='". mysqli_real_escape_string($conn, $username) ."' AND password = '". $md5_password ."' AND status=1";

	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs)){
		$rec = mysqli_fetch_assoc($rs);

		if(isset($_POST['rememberme']) && !empty($_POST['rememberme'])){
			setcookie('username', $username, time() + 60*60*24*30);
			setcookie('password', $md5_password, time() + 60*60*24*30);
		}
		
		$_SESSION['admin_user'] = $rec;
		
		addAlert('success', 'Successfully logged in to admin panel!');
		redirect('dashboard.php');
		
	}else{
		addAlert('danger', 'Username/Password is Incorrect!');
		redirect('index.php');
	}
}