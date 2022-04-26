<?php
require_once('includes/startup.php');
require_once('libraries/manage_categories_lib.php');
?>
<?php require_once('common/html_start.php'); ?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>

<form method="post" action="">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="form_category.php" class="btn btn-sm btn-outline-secondary">Add New Category</a>
          </div>

          <div class="btn-group me-2">
            <input type="submit" value="Delete" name="btnDelete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?');" />
          </div>
        </div>
      </div>
	  
	  <?php displayAlert(); ?>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"><input type="checkbox" onclick="$('.chk').prop('checked', $(this).is(':checked'));" /></th>
              <th scope="col">
                <a href="manage_categories.php?sort_by=category_id&sort_order=<?php echo $sort_order; ?>">Category ID 
                <?php if($sort_by == 'category_id'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a> 
                </th>
              <th scope="col">
              <a href="manage_categories.php?sort_by=category_name&sort_order=<?php echo $sort_order; ?>">Category name 
                <?php if($sort_by == 'category_name'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a> 
              </th>
              <th scope="col">
              <a href="manage_categories.php?sort_by=parent_id&sort_order=<?php echo $sort_order; ?>">Parent ID 
                <?php if($sort_by == 'parent_id'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col">
              <a href="manage_categories.php?sort_by=status&sort_order=<?php echo $sort_order; ?>">Status 
                <?php if($sort_by == 'status'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col">
              <a href="manage_categories.php?sort_by=date_added&sort_order=<?php echo $sort_order; ?>">Date Added 
                <?php if($sort_by == 'date_added'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col" style="width: 100px;">Action</th>
            </tr>
            <tr>
              <td>
              </td>
              <td>
                <input type="text" name="filter_category_id" value="<?php echo $filter_category_id;?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_category_name" value="<?php echo $filter_category_name; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_parent_id" value="<?php echo $filter_parent_id; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_status" value="<?php echo $filter_status; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
              <div class="row g-1">
              <div class="col-sm-6">
              <div class="input-group input-group-sm flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">From</span>
                <input type="date" class="form-control" placeholder="Categoryname" name="filter_date_added" value="<?php echo $filter_date_added; ?>">
              </div>
              </div>
              <div class="col-sm-6">
              <div class="input-group input-group-sm flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">To</span>
                <input type="date" class="form-control" placeholder="Categoryname" name="filter_date_added" value="<?php echo $filter_date_added; ?>">
                </div>
              </div>
              </div>

              </td>
              <td>
                <input type="button" value="Filter" class="btn btn-info btn-sm btnFilter" />
              </td>
            </tr>
          </thead>
          <tbody>
          <?php if(sizeof($data_categories)){ ?>
            <?php foreach($data_categories as $data_category){ ?>
              <tr>
                <td><input type="checkbox" class="chk" name="category_ids[]" value="<?php echo $data_category['category_id']; ?>" /> </td>
                <td><?php echo $data_category['category_id']; ?></td>
                <td><?php echo $data_category['category_name']; ?></td>
                <td><?php echo $data_category['parent_id']; ?></td>
                <td><?php echo ($data_category['status'] == 1)?'Active':'Inactive'; ?></td>
                <td><?php echo $data_category['date_added']; ?></td>
                <td><a href="form_category.php?category_id=<?php echo $data_category['category_id']; ?>"> Edit </a> | <a href="manage_categories.php?action=delete&category_id=<?php echo $data_category['category_id']; ?>" onclick="return confirm('Are you sure want to delete this?');">Delete</a></td>
              </tr>
            <?php } ?>
          <?php } ?>
          </tbody>
        </table>

<?php
$total_pages = ceil($category_total/$page_size);
//if($category_total > $page_size){
if($total_pages > 1){
?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php echo ($page <= 1)?'disabled':'';?>"><a class="page-link" href="manage_categories.php?page=<?php echo  ($page-1); ?><?php echo $filter_url; ?>">Previous</a></li>
    <?php 
   
    for($i = 1; $i <= $total_pages; $i++){ ?>
    <li class="page-item <?php echo ($i == $page)?'active':'';?>"><a class="page-link" href="manage_categories.php?page=<?php echo $i; ?><?php echo $filter_url; ?>"><?php echo $i; ?></a></li>
    <?php } ?>

    <li class="page-item <?php echo ($page >= $total_pages)?'disabled':'';?>"><a class="page-link" href="manage_categories.php?page=<?php echo  ($page+1); ?><?php echo $filter_url; ?>">Next</a></li>
  </ul>
</nav>
<?php } ?>

      </div>
    </main>
</form>
<?php require_once('common/scripts.php');?>
<script type="text/javascript">
  $('.btnFilter').click(function(){
    var url = 'manage_categories.php?';
    var filter_category_id = $('input[name="filter_category_id"]').val();
    if(filter_category_id != ''){
      url += '&filter_category_id=' + encodeURI(filter_category_id);
    }
    var filter_category_name = $('input[name="filter_category_name"]').val();
    if(filter_category_name != ''){
      url += '&filter_category_name=' + encodeURI(filter_category_name);
    }
    var filter_parent_id = $('input[name="filter_parent_id"]').val();
    if(filter_parent_id != ''){
      url += '&filter_parent_id=' + encodeURI(filter_parent_id);
    }
    var filter_status = $('input[name="filter_status"]').val();
    if(filter_status != ''){
      url += '&filter_status=' + encodeURI(filter_status);
    }
    var filter_date_added = $('input[name="filter_date_added"]').val();
    if(filter_date_added != ''){
      url += '&filter_date_added=' + encodeURI(filter_date_added);
    }
    
    window.location.href = url;

  });
</script>
<?php require_once('common/html_ends.php');?>