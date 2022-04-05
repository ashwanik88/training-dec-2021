<?php
require_once('includes/startup.php');
require_once('libraries/manage_users_lib.php');
?>
<?php require_once('common/html_start.php'); ?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="form_user.php" class="btn btn-sm btn-outline-secondary">Add New User</a>
          </div>
        </div>
      </div>
	  
	  <?php displayAlert(); ?>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">User ID</th>
              <th scope="col">Username</th>
              <th scope="col">Fullname</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Status</th>
              <th scope="col">Date Added</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if(sizeof($data_users)){ ?>
            <?php foreach($data_users as $data_user){ ?>
              <tr>
                <td><input type="checkbox" /> </td>
                <td><?php echo $data_user['user_id']; ?></td>
                <td><?php echo $data_user['username']; ?></td>
                <td><?php echo $data_user['fullname']; ?></td>
                <td><?php echo $data_user['email']; ?></td>
                <td><?php echo $data_user['phone_number']; ?></td>
                <td><?php echo $data_user['status']; ?></td>
                <td><?php echo $data_user['date_added']; ?></td>
                <td><a href="form_user.php?user_id=<?php echo $data_user['user_id']; ?>"> Edit </a> | Delete</td>
              </tr>
            <?php } ?>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </main>

<?php require_once('common/scripts.php');?>
<?php require_once('common/html_ends.php');?>