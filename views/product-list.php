<?php include_once('partials/header.php'); ?>

	<div class="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">ALL PRODUCTS</h1>
            </div>
        </section>

		<div class="container my-5">

			<div class="row">
                <div class="col-md-3 products-sidebar">
                    <div class="category-area">
                        <h2>Categoties</h2>
                        <ul>
                            <?php foreach($categories as $category) : ?>
                                <li>
                                    <a href="/productlist/?category=<?php echo $category->slug; ?>">
                                        <?php echo $category->name; ?>
                                        <span><?php echo $category->products_count; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="search-area mt-5">
                        <h2>Search Products</h2>
                        <form action="" method="GET">
                            <input type="search" name="search" class="search-box">
                        </form>
                    </div>
                    <div class="search-area mt-5">
                        <h2>Filter</h2>
						<select name="brand" class="form-control rounded-0"  onchange="return mySearch('brand@'+this.value)">
						<option value="">Select Brand</option>
                            <?php foreach($brands as $brand) : ?>                              
                                <option value="<?php echo $brand->id; ?>"><?php echo $brand->name; ?></option>								                      
                            <?php endforeach; ?>
						 </select>
						 <div class="my-0">&nbsp;</div>
						<select name="gender" class="form-control rounded-0" onchange="return mySearch('gender@'+this.value)">
						<option value="">Select Gender</option>                             
                                <option value="1">Men</option>
								<option value="2">Women</option>								                      
						 </select>	
						 <div class="my-0">&nbsp;</div>
                       <select name="size" class="form-control rounded-0" onchange="return mySearch('size@'+this.value)">
                                <option value="">Select size</option>
								<option value="1">S</option>
								<option value="2">M</option>
								<option value="3">L</option>
								<option value="4">XL</option>	
                                <option value="5">XXL</option>								
                        </select>					 
                    </div>					
                </div>
                <div class="col-md-9">
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
									<img id="image-gallery-image" class="img-responsive" src="/<?php echo $product->image; ?>">
								</div>
							</div>
						</div>
					</div>						
						
						
                        <div class="col-md-4 col-sm-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="#">
                                        <img class="pic-1" src="/<?php echo $product->image; ?>">
                                        <img class="pic-2" src="/<?php echo $product->image; ?>">
                                    </a>
                                    <ul class="social">
                                        <li><a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-tip="Quick View" data-target="#image-gallery<?php echo $product->id;?>"><i class="fa fa-search"></i></a></li>
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
                                    <div class="price">$<?php echo $product['sale_price']; ?>
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
						
						<?php
						
						/*  echo "<pre>";
						print_r($pagination);  */
						
						?>
						
						
                    </div>
                </div>
		    </div>

		</div>

	</div>

<?php include_once('partials/footer.php'); ?>