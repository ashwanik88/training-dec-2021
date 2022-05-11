<?php 
function redirect($page){
	header('Location: ' . $page);
	die;
}
function checkAdminLogin(){
	if(!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])){
		redirect('index.php');
	}
}

function addAlert($type, $msg){
	$_SESSION['alert']['type'] = $type;
	$_SESSION['alert']['msg'] = $msg;
	// echo '<pre>';
	// print_r($_SESSION);
	// die;
}
function displayAlert(){
	if(isset($_SESSION['alert']) && !empty($_SESSION['alert'])){
	$type = $_SESSION['alert']['type'];
	$msg = $_SESSION['alert']['msg'];
	$html = '<div class="alert alert-'. $type .' alert-dismissible fade show" role="alert">
	  '. $msg .'
	  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>';
	unset($_SESSION['alert']);
	echo $html;
	}
}

function showPhoto($filename){
    $filepath = DIR_UPLOADS . $filename;
    if(file_exists($filepath) && !empty($filename)){
        return HTTP_UPLOADS . $filename;
    }else{
        return HTTP_UPLOADS . 'preivew.png';
    }
}