<?php 
if($_POST){
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM users WHERE username='". mysqli_real_escape_string($conn, $username) ."' AND password = '". md5($password) ."'";

		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)){
			$rec = mysqli_fetch_assoc($rs);
			
			$_SESSION['admin_user'] = $rec;
			
			addAlert('success', 'Successfully logged in to admin panel!');
			redirect('dashboard.php');
			
		}else{
			addAlert('danger', 'Username/Password is Incorrect!');
			redirect('index.php');
		}
		
	}
}