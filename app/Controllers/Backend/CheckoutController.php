<?php 

namespace App\Controllers\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Useraddress;
use App\Helpers\ValidatorFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
class CheckoutController
{
	public function getIndex()
	{
        
				
		
		$user = User::find($_SESSION['userid']);
		
		$alluseraddresses = Capsule::table('useraddresses')->where('user_id', '=', $_SESSION['userid'])->orderby('id','desc')->get();
        $cart = $_SESSION['cart'] ?? [];
        
        if(empty($cart)) {
            redirect('/');
        }

		$subtotal 		= array_sum(array_column($cart,'total_price'));
		$shippingprice 	= 100;
		$grandtotal 	= $subtotal + $shippingprice;

		view('checkout', [
			'user' 		 	=> $user,
			'cart' 		 	=> $cart,
			'subtotal' 		=> $subtotal,
			'shippingprice' => $shippingprice,
			'grandtotal' 	=> $grandtotal,
			'alluseraddresses' 	=> $alluseraddresses
			
		]);
    }
    
    public function postShipping()
    {
        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $phone      = $_POST['phone'];
        $address    = $_POST['addresslist'];

        $validator = (new ValidatorFactory())->make(
		    $data = [
		    	'name' 	    => $name,
		    	'email' 	=> $email,
		    	'phone' 	=> $phone,
		    	'billing_address_id' 	=> $address
		    ],
		    $rules = [
		    	'name' 	    => 'required|max:255',
		    	'email' 	=> 'required|max:255',
		    	'phone' 	=> 'required|max:15',
		    	'billing_address_id' 	=> 'required'
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['validator-errors'] = $validator->errors()->all();

			//redirect('/checkout');
			$outputdata = array( 'code' => '500','message' => 'something wrong');							
			echo json_encode($outputdata);die;
        }

        $cart = $_SESSION['cart'] ?? [];
        $subtotal 		= array_sum(array_column($cart,'total_price'));
		$shippingprice 	= 100;
        $grandtotal 	= $subtotal + $shippingprice;
        
        $order = Order::create([
            'user_id'           => $_SESSION['userid'],
            'name' 	            => $name,
            'email' 	        => $email,
            'phone' 	        => $phone,
            'billing_address_id' 	=> $address,
            'total_amount'      => $grandtotal,
            'payment_status'    => 'pending',
            'payment_details'   => 'cash on delivery'
        ]);

        foreach($cart as $id => $product) {

            $order->products()->create([
			      'user_id'     => $_SESSION['userid'],
                'product_id'    => $id,
                'quantity'      => $product['quantity'],
                'price'         => $product['unit_price']
            ]);
        }

        $_SESSION['validator-errors'] = NULL;
        $_SESSION['cart'] = [];


			$outputdata = array( 'code' => '200','message' => 'success');							
			echo json_encode($outputdata);die;

        //redirect('/');
    }
	
	
	 public function postUaddress()
    {

        $address      = $_POST['address'];
		$addressc = Useraddress::create([
            'user_id'   => $_SESSION['userid'],
            'address' 	=> $address
        ]);

 		$outputdata = array( 'code' => '200','message' => 'success');							
	    echo json_encode($outputdata);die;
	}
	
	
	
}


