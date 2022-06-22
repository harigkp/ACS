<?php include_once('partials/header.php'); ?>

<?php include_once('partials/slider.php'); ?>

	<div class="main">

		<div class="container my-5">

			<div class="row">
				<?php foreach($products as $product) : ?>
				
	<div class="modal fade" id="image-gallery<?php echo $product->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:10000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
			<h4 class="modal-title float-left" id="image-gallery-title"><?php echo $product->title; ?></h4>
                <button type="button" class="close float-right" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive" src="<?php echo $product->image; ?>">
            </div>
        </div>
    </div>
</div>					
				
				
				
		        <div class="col-md-3 col-sm-6">
		            <div class="product-grid">
		                <div class="product-image">
		                    <a href="#">
		                        <img class="pic-1" src="<?php echo $product->image; ?>">
		                        <img class="pic-2" src="<?php echo $product->image; ?>">
		                    </a>

		                    <ul class="social">
		                        <li>
								
								<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-tip="Quick View" data-target="#image-gallery<?php echo $product->id;?>"><i class="fa fa-search"></i></a></li>
		                        <li>
									<form action="/cart/addcart" method="post">
										<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
										<button type="submit" class="add-to-cart p-0" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
									</form>
								</li>
		                    </ul>
							
					
							
							
		                    <span class="product-new-label">Sale</span>
		                    <span class="product-discount-label">20%</span>
		                </div>
		                <ul class="rating">
		                    <li class="fa fa-star"></li>
		                    <li class="fa fa-star"></li>
		                    <li class="fa fa-star"></li>
		                    <li class="fa fa-star"></li>
		                    <li class="fa fa-star disable"></li>
		                </ul>
		                <div class="product-content">
		                    <h3 class="title">
								<a href="/product/<?php echo $product->slug; ?>"><?php echo $product->title; ?></a>
							</h3>
		                    <div class="price">$<?php echo $product->sale_price; ?>
		                        <span>$<?php echo $product->price; ?></span>
		                    </div>
							<form action="/cart/addcart" method="post">
								<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
								<button type="submit" class="add-to-cart p-0">+ Add To Cart</button>
							</form>
		                </div>
		            </div>
				</div>
				<?php endforeach; ?>

		
		    </div> <!-- end .row -->

		</div>

	</div>

<?php include_once('partials/footer.php'); ?>