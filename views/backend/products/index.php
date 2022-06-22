            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Products</h1>
                
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
						<th>Brand</th>
						<th>Gender</th>
						<th>Size</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Slider</th>
                        <th>Active</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product) : ?>
                        <tr>
                            <td><?php echo $product->id; ?></td>
                            <td>
                                <?php if(file_exists($product->image)) : ?>
                                    <img width="20px" src="/<?php echo $product->image; ?>" alt="<?php echo $product->title; ?>">
                                <?php endif; ?>
                            </td>
                            <td><?php echo $product->title; ?></td>
                            <td><?php echo $product->category->name; ?></td>
							<td><?php echo $product->brand->name; ?></td>
							<td><?php if($product->gender==1){?> Men <?php }else{ ?>Women<?php } ?></td>
							<td><?php if($product->size==1){?> S <?php } ?>
								<?php if($product->size==2){?> M <?php } ?>
								<?php if($product->size==3){?> L <?php } ?>
								<?php if($product->size==4){?> XL <?php } ?>
                                <?php if($product->size==5){?> XXL <?php } ?></td>
                            <td>$<?php echo $product->price; ?></td>
                            <td>$<?php echo $product->sale_price; ?></td>
                            <td>
                                <?php if($product->active_on_slider) : ?>
                                    <button type="button" class="badge badge-success rounded-0 border-0 p-1">active</button>
                                <?php else: ?>
                                    <button type="button" class="badge badge-danger rounded-0 border-0 p-1">inactive</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($product->active) : ?>
                                    <button type="button" class="badge badge-success rounded-0 border-0 p-1">active</button>
                                <?php else: ?>
                                    <button type="button" class="badge badge-danger rounded-0 border-0 p-1">inactive</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a id="proe" href="javascript:void(0);" onclick="return product_edit(<?php echo $product->id; ?>);"  class="badge badge-warning rounded-0 text-white">
                                    <span data-feather="edit">Edit</span>
                                </a>
                                <a  id="dash" href="javascript:void(0);"  onclick="return product_del(<?php echo $product->id; ?>);" class="badge badge-danger rounded-0">
                                    <span data-feather="trash-2">Delete</span><span id="loaderID" style="color:red;display:none;"><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/images/loading.gif"/><span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
			
<script>			
function product_del(deleteID){
	var chk = confirm('Are you sure, you want to delete product!');
	if(chk){
		$('#loaderID').show();

		 $.ajax({
			url: "/dashboard/products/delete/"+deleteID,
			type: "get",
			data: {},
			success: function (response) {
				$('#loaderID').hide();
				//var objJSON = JSON.parse(response);
                 var objJSON = JSON.parse(JSON.stringify(response));
                // alert(objJSON.code)


				//if(objJSON.code==200){					 
					 $('#pro').click();
				//}else{
					// $("#errorc").html(objJSON.message);
					 
				// }
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});
	}
}
</script>