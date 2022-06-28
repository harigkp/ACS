
<?php include_once('partials/header.php'); ?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">E-COMMERCE CHECKOUT <span id="errorc" style="color:red;"><span></h1>
    </div>
</section>

<div class="container">

    <?php //backendpartials('validator');	?>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">
                    <?php echo count($cart); ?>
                </span>
            </h4>
            <ul class="list-group mb-3">

                <?php foreach($cart as $id => $product) : ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $product['title']; ?></h6>
                            <small class="text-muted">Quantity: <?php echo $product['quantity']; ?></small>
                        </div>
                        <span class="text-muted">$<?php echo $product['total_price']; ?></span>
                    </li>
                <?php endforeach; ?>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Sub-Total</span>
                    $<?php echo $subtotal; ?>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Shipping Price</span>
                    $<?php echo $shippingprice; ?>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?php echo $grandtotal; ?></strong>
                </li>
            </ul>

        </div>
        <div class="col-md-8 order-md-1 mb-4">
            <h4 class="mb-3">Billing address</h4>

            <form class="needs-validation" id="frmid" action="/checkout/shipping" method="post">

                <div class="mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" name="name" readonly value="<?php echo $user->name; ?>" required="">
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" readonly name="email" value="<?php echo $user->email; ?>">
                </div>

                <div class="mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required="">
					<small class="form-text text-danger phoneerror"></small> 
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    
					<div class="input-group mb-3">
					  <select class="custom-select" id="addresslist" name="addresslist">
					  <?php foreach ($alluseraddresses as $alluseraddresse) : ?>
						<option value="<?php echo $alluseraddresse->id; ?>"><?php echo $alluseraddresse->address; ?></option>
                      <?php endforeach; ?>						
					  </select>
					  
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#exampleModalLong">Create Address</button>
					  </div>
					  
					</div>
					
					
					
					
                </div>
				<small class="form-text text-danger addresserror2"></small>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" id="checkoutbutton" type="button">Continue to checkout</button>
            </form>
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form class="needs-validation" id="frmaddid" action="/checkout/address" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><h3>Billing Address   <span id="loaderID1" style="color:red;display:none">Please wait<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/images/loading.gif"/><span></h3></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="mb-3">
			<input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" required="">
			<small class="form-text text-danger addresserror"></small>
		</div>

      </div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addressbutton">Save changes</button>
      </div>
    </div>
	</form>
  </div>
</div>
<script>
jQuery(document).ready(function($){

    $('#checkoutbutton').on('click', function(){
		var phoneNumberPattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

		
		var phone = $('#phone').val();
		var addresslist = $('#addresslist').val();
		/* alert(addresslist);
		alert(phone.length); */
		if(phone==""){
			$('.phoneerror').html("The phone field is required.");
			return  false;			
		}else{
			$('.phoneerror').html("");
		}
		if (phoneNumberPattern.test(phone)) {
			if(phone.length==='10'){
				$('.phoneerror').html("Please enter valid phone number.");
				return  false;			
			}		
		}
		if(addresslist=="" || addresslist==null){
			$('.addresserror2').html("The address field is required.");
			return  false;			
		}	
		

		let data = new FormData($("#frmid")[0]);
          $('#loaderID').show();
		  $.ajax({
			url: '/checkout/shipping',
			type: 'POST',
			data: data,
			processData: false,
			contentType: false,
			success: function(response) {
					$('#loaderID').hide();
					var objJSON = JSON.parse(response);
					
				   if(objJSON.code==200){					 
						 window.location.href = '/';
					 }else{
						 $("#errorc").html(objJSON.message);
						 
					 }
			},
			error: function(response) {
			  console.log('error', response);
			}
		  });
		
  });
  
  
  /* Create address*/
  
     $('#addressbutton').on('click', function(){

		var address = $('#address').val();
		if(address==""){
			$('.addresserror').html("The address field is required.");
			return  false;			
		}			
		

		let data1 = new FormData($("#frmaddid")[0]);
          $('#loaderID1').show();
		  $.ajax({
			url: '/checkout/uaddress',
			type: 'POST',
			data: data1,
			processData: false,
			contentType: false,
			success: function(response) {
			var objJSON = JSON.parse(response);	
					$('#loaderID1').hide();
				   if(objJSON.code==200){					 
						 window.location.href = '/checkout';
					 }else{
						 $("#loaderID1").html(objJSON.message);
						 
					 } 
			},
			error: function(response) {
			  console.log('error', response);
			}
		  });
		
  }); 
  
  

});		
		
		
</script>
<?php include_once('partials/footer.php'); ?>