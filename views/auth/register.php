<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>PHP E-COMMERCE</title>
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
</head>
<body>

	<div class="login-sidenav">
		<div class="login-main-text">
			<a class="py-2" href="/">
				<img src="https://acsicorp.com/wp-content/uploads/2021/06/ACS-Solutions-Registered-SVG-White.svg" width="124" height="40" ><title>Product</title>
			</a>
		   <h2>Application<br> Registration</h2>
		   <p><a href="/login">Login</a> or register from here to access.</p>
		</div>
	</div>
	<div class="main-login-area">
		<div class="col-md-6 col-sm-12">

			<div class="session-msg mt-5" id="uni">
				<?php partials('notifications'); ?>
			</div>

		    <div class="register-form">
		       <form action="" method="post">
		          <div class="form-group">
		             <label>Name</label>
		             <input type="text" name="name" id="uname" class="form-control rounded-0" placeholder="User Name">
		             
		             	 <small class="form-text text-danger uname"></small>

		          </div>
		          <div class="form-group">
		             <label>Email</label>
		             <input type="email" name="email" id="uemail" class="form-control rounded-0" placeholder="User Email">
		             
		             	 <small class="form-text text-danger uemail"></small>

		          </div>
		          <div class="form-group">
		             <label>Password</label>
		             <input type="password" name="password" id="upass" class="form-control rounded-0" placeholder="Password">
		             
		             	 <small class="form-text text-danger upass"></small>
	
		          </div>		          
		          <button type="button" id="register" name="register" class="btn btn-black rounded-0">Register</button>
		          <a href="/login" class="btn btn-default rounded-0"> Already registered?</a><span id="loaderID" style="color:red;display:none;">Please wait<img src="../assets/images/loading.gif"/><span>
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

    $('#register').on('click', function(){
		
		var username = $('#uname').val();
		var email = $('#uemail').val();
		var password = $('#upass').val();
		var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		

		if(username==""){			
			$('.uname').html("The name field is required.");
			return  false;
		}
		if(username.length<3){			
			$('.uname').html("Minimum three character required.");
			return  false;
		}		
		if(email==""){			
			$('.uemail').html("The email field is required.");
			return  false;
		}
		if(!pattern.test(email)){			
			$('.uemail').html("Please provide a valid email address.");
			return  false;
		}
		if(password==""){			
			$('.upass').html("The password field is required.");
			return  false;
		}
		if(password.length<6){			
			$('.upass').html("Minimum six character required");
			return  false;
		}		
		
		registration(username,email,password,'<?php echo BASE;?>');	
		
  });

});		
		
		
</script>