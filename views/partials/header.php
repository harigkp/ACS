<?php 
$hide = '';
if($_SESSION['admin']==0){	
	$txt = '<a class="py-2 d-none d-md-inline-block" href="/dashboard">My Orders</a>';	
}else{
	$txt = '<a class="py-2 d-none d-md-inline-block" href="/dashboard">Admin</a>';
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>ACS E-COMMERCE</title>
		<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/css/fortawesome/fontawesome-free/css/all.css">
		<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/css/app.css">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/js/ajax.js"></script>
	</head>
	<body>
		<nav class="site-header sticky-top py-1">
			<div class="container d-flex flex-column flex-md-row justify-content-between">
				<a class="py-2" href="/">
					<img src="https://acsicorp.com/wp-content/uploads/2021/06/ACS-Solutions-Registered-SVG-White.svg" width="124" height="40" ><title>Product</title>
				</a>
				<a class="py-2 d-none d-md-inline-block" href="/">Home</a>
				<a class="py-2 d-none d-md-inline-block" href="/productlist">Products</a>
				<a class="py-2 d-none d-md-inline-block" href="/cart">Cart <span style="color: #fff;">(<?php echo count($_SESSION['cart']);?>)</span></a>

				<?php if(isset($_SESSION['login'])): ?>
					<a class="py-2 d-none d-md-inline-block" href="/checkout">Checkout</a>
					<a class="py-2 d-none d-md-inline-block" href="/logout">Logout</a>
					<?php echo $txt;?>
				<?php else: ?>
					<a class="py-2 d-none d-md-inline-block" href="/login">Login</a>
					<a class="py-2 d-none d-md-inline-block" href="/register">Register</a>
				<?php endif; ?>
			</div>
		</nav>