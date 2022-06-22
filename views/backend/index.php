  <?php include_once('partials/header.php'); ?>

  <div class="container-fluid">
    <div class="row">
      
      <?php include_once('partials/sidebar.php'); ?>
	  
	  

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="display_data">
            <span id="loaderID" style="color:red;display:none;">Please wait<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/images/loading.gif"/><span>
      </main>
    </div>
  </div>

  <?php include_once('partials/footer.php'); ?>