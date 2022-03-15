<?php 
session_start();	// complusary
require_once('config.php');
require_once('includes/conn.php');

// $_SESSION['user'] = 123;
// echo '<pre>';
// print_R($_SESSION);
// die;

if($_POST){
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM users WHERE username='". mysqli_real_escape_string($conn, $username) ."' AND password = '". md5($password) ."'";

		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)){
			$rec = mysqli_fetch_assoc($rs);
			
			$_SESSION['admin_user'] = $rec;
			
			header('Location: dashboard.php');
			die;
		}else{
			echo 'Error: username/password is incorrect!';
			die;
		}
		
	}
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	
    <title>Admin Login</title>

    
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
<meta name="theme-color" content="#7952b3">

    <link href="assets/css/signin.css" rel="stylesheet">
	
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="POST" action="">
    <img class="mb-4" src="assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–<?php echo date('Y'); ?></p>
  </form>
</main>
  </body>
</html>
