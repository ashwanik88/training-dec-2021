<?php
require_once('includes/startup.php');
require_once('libraries/form_category_lib.php');
?>
<?php require_once('common/html_start.php'); ?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="manage_categories.php" class="btn btn-sm btn-outline-secondary">Back</a>
          </div>
        </div>
      </div>
	  
	  <?php displayAlert(); ?>

<form id="frm" action="" method="post" autocomplete="off">
<div class="mb-3 row">
    <label for="parent_id" class="col-sm-2 col-form-label">Select Parent Category</label>
    <div class="col-sm-10">
      <select class="form-control required" id="parent_id" name="parent_id">
        <option value=""></option>
        <?php if(sizeof($data_categories)){ ?>
          <?php foreach($data_categories as $data_category){ ?>
            <option value="<?php echo $data_category['category_id']; ?>"><?php echo $data_category['category_name']; ?></option>

            <?php $data_child = getCategories($data_category['category_id']); ?>

            <?php if(sizeof($data_child)){ 
              foreach($data_child as $child){ ?>
                <option value="<?php echo $child['category_id']; ?>"><?php echo '|___' . $child['category_name']; ?></option>

              <?php $data_child2 = getCategories($child['category_id']); ?>
              <?php if(sizeof($data_child2)){ 
              foreach($data_child2 as $child2){ ?>
                <option value="<?php echo $child2['category_id']; ?>"><?php echo '|______' . $child2['category_name']; ?></option>
              <?php } } ?>

              <?php } } ?>

          <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="category_name" class="col-sm-2 col-form-label">Category name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control required" id="category_name" name="category_name" value="<?php echo $category_name; ?>">
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
<script type="text/javascript" src="assets/jquery/validation/jquery.validate.min.js"></script>
<script type="text/javascript">
  $('#frm').validate();
</script>
<?php require_once('common/html_ends.php');?>