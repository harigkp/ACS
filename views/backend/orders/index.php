
<?php backendpartials('header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php backendpartials('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Orders &amp; Products</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
						<th>Order Status</th>
						<th>Order By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order) : 
						
						$i=0;
							$product = $product::find($order->product_id);

                            $user = $user::find($order->user_id);
						
						
						?>
						
                        <tr>
                            <td><?php echo $order->id; ?></td>
                            <td><?php echo $order->order_id; ?></td>
                            <td><?php echo $product->title; ?></td>
                            <td><?php echo $order->quantity; ?></td>
                            <td><?php echo $order->price; ?></td>
							<td><?php if($address[$i]->payment_status =='pending') { echo "Pending"; }else{ echo "Success";}?></td>                           
							<td><?php echo $user->name; ?></td>
                        </tr>
						<?php $i++;?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php backendpartials('footer'); ?>