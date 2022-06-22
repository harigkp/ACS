            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Create Products</h1>
                <div class="mb-2 mb-md-0">
                    <a id="pro" href="javascript:void(0);"  onclick="return product_create('pro');" class="btn btn-sm btn-outline-secondary rounded-0">Back</a>
                </div>
            </div>

            <form action="/dashboard/products/store" id="frmid" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="title" class="form-control rounded-0">
						<small class="form-text text-danger titleerror"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="form-control rounded-0">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
						<small class="form-text text-danger categoryerror"></small>
                    </div>
                </div>  
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <select name="brand_id" id="brand_id" class="form-control rounded-0">
                            <?php foreach ($brands as $brand) : ?>
                                <option value="<?php echo $brand->id; ?>"><?php echo $brand->name; ?></option>
                            <?php endforeach; ?>
                        </select>
						<small class="form-text text-danger branderror"></small>
                    </div>
                </div>				
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="descp" class="form-control rounded-0"></textarea>
						<small class="form-text text-danger descperror"></small>
                    </div>
                </div>         
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" id="price" name="price" class="form-control rounded-0">
						<small class="form-text text-danger priceerror"></small>
                    </div>
                </div>         
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sale Price</label>
                    <div class="col-sm-10">
                        <input type="number" id="saleprice" name="sale_price" class="form-control rounded-0">
						<small class="form-text text-danger salepriceerror"></small>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <select name="size" id="prodsize" class="form-control rounded-0">
                                <option value="">Select size</option>
								<option value="1">S</option>
								<option value="2">M</option>
								<option value="3">L</option>
								<option value="4">XL</option>	
                                <option value="5">XXL</option>								
                        </select>
						<small class="form-text text-danger prodsizeerror"></small>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" id="prodgender" class="form-control rounded-0">
                                <option value="">Select gender</option>
								<option value="1">Men</option>
								<option value="2">Women</option>
                        </select>
						<small class="form-text text-danger gendererror"></small>
                    </div>
                </div>				
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" class="form-control-file">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gallery Image</label>
                    <div class="col-sm-10">
                        <input type="file" name="gallery[]" class="form-control-file" multiple>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Active</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="active" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">Active</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Active on Slider</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="active_on_slider" id="active_on_slider">
                            <label class="form-check-label" for="active_on_slider">Active</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="button" id="prodbutton" class="btn btn-primary rounded-0">Create</button>
                    </div>
                </div>
            </form>


<script>
jQuery(document).ready(function($){

    $('#prodbutton').on('click', function(){

		var title = $('#title').val();
		var descp = $('#descp').val();
		var price = $('#price').val();
		var saleprice = $('#saleprice').val();
		var prodsize = $('#prodsize').val();
		var prodgender = $('#prodgender').val();
		var category_id = $('#category_id').val();
		var brand_id = $('#brand_id').val();

				
		if(title==""){			
			$('.titleerror').html("The title field is required.");
			return  false;
		}
		if(descp==""){			
			$('.descperror').html("The description field is required.");
			return  false;
		}
		if(price==""){			
			$('.priceerror').html("The price field is required.");
			return  false;
		}
		if(saleprice==""){			
			$('.salepriceerror').html("The sale price field is required.");
			return  false;
		}
		if(prodsize==""){				
			$('.prodsizeerror').html("The size field is required.");
			return  false;
		}
		if(prodgender==""){				
			$('.gendererror').html("The gender field is required.");
			return  false;
		}				
		$('.titleerror').html();
		$('.categoryerror').html();
		$('.branderror').html();
		$('.descperror').html();
		$('.priceerror').html();
		$('.salepriceerror').html();
		$('.prodsizeerror').html();
		$('.gendererror').html();
		
		let data = new FormData($("#my_form")[0]);

		  $.ajax({
			url: 'dashboard/products/store',
			type: 'POST',
			data: data,
			processData: false,
			contentType: false,
			success: function(r) {
			  console.log('success', r);
			},
			error: function(r) {
			  console.log('error', r);
			}
		  });
		
  });

});		
		
		
</script>