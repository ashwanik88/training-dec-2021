<?php
require_once('includes/startup.php');
require_once('libraries/manage_products_lib.php');
?>
<?php require_once('common/html_start.php'); ?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>

<form method="post" action="">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="form_product.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
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
                <a href="manage_products.php?sort_by=product_id&sort_order=<?php echo $sort_order; ?>">Product ID 
                <?php if($sort_by == 'product_id'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a> 
                </th>
              <th scope="col">
              <a href="manage_products.php?sort_by=product_name&sort_order=<?php echo $sort_order; ?>">Product Name 
                <?php if($sort_by == 'product_name'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a> 
              </th>
              <th scope="col">
              <a href="manage_products.php?sort_by=fullname&sort_order=<?php echo $sort_order; ?>">Fullname 
                <?php if($sort_by == 'fullname'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col">
              <a href="manage_products.php?sort_by=email&sort_order=<?php echo $sort_order; ?>">Email 
                <?php if($sort_by == 'email'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col">
              <a href="manage_products.php?sort_by=phone_number&sort_order=<?php echo $sort_order; ?>">Phone 
                <?php if($sort_by == 'phone_number'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col">
              <a href="manage_products.php?sort_by=status&sort_order=<?php echo $sort_order; ?>">Status 
                <?php if($sort_by == 'status'){ ?>
                <span data-feather="chevron-<?php echo ($sort_order == 'ASC')?'down':'up'; ?>"></span>
                <?php } ?>
              </a>
              </th>
              <th scope="col">
              <a href="manage_products.php?sort_by=date_added&sort_order=<?php echo $sort_order; ?>">Date Added 
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
                <input type="text" name="filter_product_id" value="<?php echo $filter_product_id;?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_product_name" value="<?php echo $filter_product_name; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_fullname" value="<?php echo $filter_fullname; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_email" value="<?php echo $filter_email; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_phone" value="<?php echo $filter_phone; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
                <input type="text" name="filter_status" value="<?php echo $filter_status; ?>" class="form-control form-control-sm"/>
              </td>
              <td>
              <div class="row g-1">
              <div class="col-sm-6">
              <div class="input-group input-group-sm flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">From</span>
                <input type="date" class="form-control" placeholder="Product Name" name="filter_date_added" value="<?php echo $filter_date_added; ?>">
              </div>
              </div>
              <div class="col-sm-6">
              <div class="input-group input-group-sm flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">To</span>
                <input type="date" class="form-control" placeholder="Product Name" name="filter_date_added" value="<?php echo $filter_date_added; ?>">
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
          <?php if(sizeof($data_products)){ ?>
            <?php foreach($data_products as $data_product){ ?>
              <tr>
                <td><input type="checkbox" class="chk" name="product_ids[]" value="<?php echo $data_product['product_id']; ?>" /> </td>
                <td><?php echo $data_product['product_id']; ?></td>
                <td><?php echo $data_product['product_name']; ?></td>
                <td>
                <img src="<?php echo showPhoto($data_product['photo']); ?>"  width="100px" /> <br>
                <?php echo $data_product['fullname']; ?></td>
                <td><?php echo $data_product['email']; ?></td>
                <td><?php echo $data_product['phone_number']; ?></td>
                <td><?php echo ($data_product['status'] == 1)?'Active':'Inactive'; ?></td>
                <td><?php echo $data_product['date_added']; ?></td>
                <td><a href="form_product.php?product_id=<?php echo $data_product['product_id']; ?>"> Edit </a> | <a href="manage_products.php?action=delete&product_id=<?php echo $data_product['product_id']; ?>" onclick="return confirm('Are you sure want to delete this?');">Delete</a></td>
              </tr>
            <?php } ?>
          <?php } ?>
          </tbody>
        </table>

<?php
$total_pages = ceil($product_total/$page_size);
//if($product_total > $page_size){
if($total_pages > 1){
?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php echo ($page <= 1)?'disabled':'';?>"><a class="page-link" href="manage_products.php?page=<?php echo  ($page-1); ?><?php echo $filter_url; ?>">Previous</a></li>
    <?php 
   
    for($i = 1; $i <= $total_pages; $i++){ ?>
    <li class="page-item <?php echo ($i == $page)?'active':'';?>"><a class="page-link" href="manage_products.php?page=<?php echo $i; ?><?php echo $filter_url; ?>"><?php echo $i; ?></a></li>
    <?php } ?>

    <li class="page-item <?php echo ($page >= $total_pages)?'disabled':'';?>"><a class="page-link" href="manage_products.php?page=<?php echo  ($page+1); ?><?php echo $filter_url; ?>">Next</a></li>
  </ul>
</nav>
<?php } ?>

      </div>
    </main>
</form>
<?php require_once('common/scripts.php');?>
<script type="text/javascript">
  $('.btnFilter').click(function(){
    var url = 'manage_products.php?';
    var filter_product_id = $('input[name="filter_product_id"]').val();
    if(filter_product_id != ''){
      url += '&filter_product_id=' + encodeURI(filter_product_id);
    }
    var filter_product_name = $('input[name="filter_product_name"]').val();
    if(filter_product_name != ''){
      url += '&filter_product_name=' + encodeURI(filter_product_name);
    }
    var filter_fullname = $('input[name="filter_fullname"]').val();
    if(filter_fullname != ''){
      url += '&filter_fullname=' + encodeURI(filter_fullname);
    }
    var filter_email = $('input[name="filter_email"]').val();
    if(filter_email != ''){
      url += '&filter_email=' + encodeURI(filter_email);
    }
    var filter_phone = $('input[name="filter_phone"]').val();
    if(filter_phone != ''){
      url += '&filter_phone=' + encodeURI(filter_phone);
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