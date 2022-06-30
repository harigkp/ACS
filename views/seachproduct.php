
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
									<button style="color:blue" class="add-to-cart p-0" type="button" data-toggle="modal" data-target="#reviewModalLong<?php echo $product->id;?>">Review</button> | <button style="color:blue" class="add-to-cart p-0" type="button" data-toggle="modal" data-target="#commentModalLong<?php echo $product->id;?>">Comment</button>	</h3>
                                </div>
                            </div>
                        </div>
						
						
<!-- Modal review-->
<div class="modal fade" id="reviewModalLong<?php echo $product->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form class="needs-validation" id="frmreview<?php echo $product->id;?>" action="/checkout/address" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><h3>Review<span id="loaderID<?php echo $product->id;?>" style="color:red;display:none">Please wait<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/images/loading.gif"/><span></h3></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="mb-3">
			<input type="text" class="form-control" id="rtxt<?php echo $product->id;?>" placeholder="Enter Review" name="rtxt<?php echo $product->id;?>" required="">
			<small class="form-text text-danger reviewerror<?php echo $product->id;?>"></small>
		</div>
                    <span id="loaderID<?php echo $product->id;?>" style="color:red;display:none;">Please wait<img src="<?php echo BASE;?>/assets/images/loading.gif"/><span>
      </div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="review@<?php echo $product->id;?>" onclick="return savereview(this.id);">Save changes</button>
      </div>
    </div>
	</form>
  </div>
</div>

<!-- Modal comment -->

<div class="modal fade" id="commentModalLong<?php echo $product->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form class="needs-validation" id="frmreview<?php echo $product->id;?>" action="/checkout/address" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><h3>Comment<span id="loaderIDcomment" style="color:red;display:none">Please wait<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/images/loading.gif"/><span></h3></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="mb-3">
			<input type="text" class="form-control" id="ctxt<?php echo $product->id;?>" placeholder="Enter Comment" name="ctxt<?php echo $product->id;?>" required="">
			<small class="form-text text-danger commenterror<?php echo $product->id;?>"></small>
		</div>
                    <span id="loaderIDc<?php echo $product->id;?>" style="color:red;display:none;">Please wait<img src="<?php echo BASE;?>/assets/images/loading.gif"/><span>
      </div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="comment@<?php echo $product->id;?>" onclick="return savecomment(this.id);">Save changes</button>
      </div>
    </div>
	</form>
  </div>
</div>						
						
						
						
						
						
						
                        <?php endforeach; ?>
						
						<?php
						
						/*  echo "<pre>";
						print_r($pagination);  */
						
						?>
						
						
                    </div>
