<?php
$base_url = 'http://'.$_SERVER['HTTP_HOST'];
$api_login = 'http://'.$_SERVER['HTTP_HOST'].'/api/cart-api.php?rquest=login';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ACS E-COMMERCE</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/assets/css/login.css">
</head>
<body>

	<div class="login-sidenav">
		<div class="login-main-text">
			<a class="py-2" href="/">
				<img src="https://acsicorp.com/wp-content/uploads/2021/06/ACS-Solutions-Registered-SVG-White.svg" width="124" height="40" ><title>Product</title>
			</a>
		   <h2>Application<br> Login</h2>
		   <p>Login or <a href="/register">Register</a> from here to access.</p>
		</div>
	</div>
	<div class="main-login-area">
		<div class="col-md-6 col-sm-12">

			<div class="session-msg mt-5" id="logi">

				<?php partials('notifications'); ?>

			</div>

		    <div class="login-form">
		       <form action="/login" method="post">
		          <div class="form-group">
		             <label>User Email</label>
		             <input type="email" name="email" id="uemail" class="form-control rounded-0" placeholder="User Email">

		             	 <small class="form-text text-danger uemail"></small>

		          </div>
		          <div class="form-group">
		             <label>Password</label>
		             <input type="password" name="password" id="upassword" class="form-control rounded-0" placeholder="Password">

		             	 <small class="form-text text-danger upassword" id="upasserr"></small>

		          </div>
		          <button type="button" class="btn btn-black rounded-0" id="login">Login</button>
		          <a href="/register" class="btn btn-default">Not member yet?</a><span id="loaderID" style="color:red;display:none;">Please wait<img src="<?php echo $base_url;?>/assets/images/loading.gif"/><span>
		       </form>
		    </div>
		</div>
	</div>
	<script src="../node_modules/jquery/dist/jquery.min.js" type="text/javascript"></script>
	<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/ajax_login_reg.js" type="text/javascript"></script>
</body>
</html>

<script>
jQuery(document).ready(function($){

    $('#login').on('click', function(){
		
		var email = $('#uemail').val();
		var password = $('#upassword').val();
		var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				
		if(email==""){			
			$('.uemail').html("The email field is required.");
			return  false;
		}
		if(!pattern.test(email)){			
			$('.uemail').html("Please provide a valid email address.");
			return  false;
		}
		if(password==""){			
			$('.upassword').html("The password field is required.");
			return  false;
		}
		if(password.length<6){			
			$('.upassword').html("Minimum six character required");
			return  false;
		}		
		$('.uemail').html("");
		$('.upassword').html("");
		
		login(email,password);	
		
  });

});		
		
		
</script>