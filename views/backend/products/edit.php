
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Edit Product</h1>
                
            </div>

            <?php backendpartials('validator'); ?>

            <form action="/dashboard/products/update" method="POST" id="frmid" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control rounded-0" value="<?php echo $product->title; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select name="category_id" class="form-control rounded-0">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category->id; ?>" <?php if($product->category_id==$category->id){?> selected <?php } ?>><?php echo $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>  
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <select name="brand_id" class="form-control rounded-0">
                            <?php foreach ($brands as $brand) : ?>
                                <option value="<?php echo $brand->id; ?>" <?php if($product->brand_id==$brand->id){?> selected <?php } ?>><?php echo $brand->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>				
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control rounded-0"><?php echo $product->description; ?></textarea>
                    </div>
                </div>         
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" name="price" class="form-control rounded-0" value="<?php echo $product->price; ?>">
                    </div>
                </div>         
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sale Price</label>
                    <div class="col-sm-10">
                        <input type="number" name="sale_price" class="form-control rounded-0" value="<?php echo $product->sale_price; ?>">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <select name="size" class="form-control rounded-0">
                                <option value="">Select size</option>
								<option value="1" <?php if($product->size==1){?> selected <?php } ?>>S</option>
								<option value="2" <?php if($product->size==2){?> selected <?php } ?>>M</option>
								<option value="3" <?php if($product->size==3){?> selected <?php } ?>>L</option>
								<option value="4" <?php if($product->size==4){?> selected <?php } ?>>XL</option>	
                                <option value="5" <?php if($product->size==5){?> selected <?php } ?>>XXL</option>								
                        </select>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-control rounded-0">
                                <option value="">Select gender</option>
								<option value="1" <?php if($product->gender==1){?> selected <?php } ?>>Men</option>
								<option value="2" <?php if($product->gender==2){?> selected <?php } ?>>Women</option>
                        </select>
                    </div>
                </div>				
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-6">
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="col-sm-4 text-right">
                        <img width="30px" src="/<?php echo $product->image; ?>" alt="<?php echo $product->title; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gallery Image</label>
                    <div class="col-sm-4">
                        <input type="file" name="gallery[]" class="form-control-file" multiple>
                    </div>
                    <div class="col-sm-6 text-right">
                        <?php foreach($product->images as $gallery) : ?>
                            <a href="/dashboard/products/gallery-delete/<?php echo $gallery->id; ?>" class="product-gallery"
                                onclick=" return confirm('Are you sure, you want to delete product gallery image!');">
                                <img src="/<?php echo $gallery->image; ?>" width="30px" alt="<?php echo $product->title; ?>"/>
                                <span class="icon"><span data-feather="trash-2"></span></span>
                            <a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Active</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="active" id="gridCheck2" <?php echo $product->active ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gridCheck2">Active</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Active on Slider</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="active_on_slider" id="activeonslider" <?php echo $product->active_on_slider ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="activeonslider">Active</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="button" id="prodbutton" class="btn btn-primary rounded-0">Update</button> <span id="loaderID" style="color:red;display:none;">Please wait<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/images/loading.gif"/><span>
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
		
		let data = new FormData($("#frmid")[0]);
          $('#loaderID').show();
		  $.ajax({
			url: 'dashboard/products/update',
			type: 'POST',
			data: data,
			processData: false,
			contentType: false,
			success: function(response) {
					$('#loaderID').hide();
					var objJSON = JSON.parse(response);
					
				   if(objJSON.code==200){					 
						 $('#pro').click();
					 }else{
						 $("#errorc").html(objJSON.message);
						 
					 }
			},
			error: function(response) {
			  console.log('error', response);
			}
		  });
		
  });

});		
		
		
</script>