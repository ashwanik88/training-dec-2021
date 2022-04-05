<?php
require_once('includes/startup.php');
require_once('libraries/form_user_lib.php');
?>
<?php require_once('common/html_start.php'); ?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="manage_users.php" class="btn btn-sm btn-outline-secondary">Back</a>
          </div>
        </div>
      </div>
	  
	  <?php displayAlert(); ?>

<form id="frm" action="" method="post">
  
  <div class="mb-3 row">
    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required" id="username" name="username" value="<?php echo $username; ?>">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" value="">
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="cpassword" name="cpassword" value="" equalto="#password">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="fullname" class="col-sm-2 col-form-label">Fullname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required" id="fullname" name="fullname" value="<?php echo $fullname; ?>">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required email" id="email" name="email" value="<?php echo $email; ?>">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="r1" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
      
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="r1" value="1" checked>
        <label class="form-check-label" for="r1"> Active </label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="r2" value="0">
        <label class="form-check-label" for="r2"> Inactive </label>
      </div>

    </div>
  </div>

  <div class="mb-3 row">
    <div class="col-sm-10 offset-sm-2">
      <input type="submit" class="btn btn-primary" id="btn" name="btn" value="Submit">
    </div>
  </div>



</form>

    
    </main>

<?php require_once('common/scripts.php');?>
<script type="text/javascript" src="assets/jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/jquery/validation/jquery.validate.min.js"></script>
<script type="text/javascript">
  $('#frm').validate();
</script>
<?php require_once('common/html_ends.php');?>