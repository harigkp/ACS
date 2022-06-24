<?php 

namespace App\Controllers\Backend;


use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Product;

class DashboardController
{
	public function getIndex()
	{
		if(!$_SESSION['admin']){
			header('Location: '.BASE.'/dashboard/orders');
            exit;
		}
		
		
		view('backend/index');
	}

	public function getOrders()
	{
		
		if(!$_SESSION['admin']){
			$orders  	= OrderProduct::where('user_id',$_SESSION['userid'])->get();
		}else{
			$orders = OrderProduct::all();
		}
		
		$address 	= Order::with('products')->get(); 
		$product = new Product();
		$user = new User();
		
		if(!$_SESSION['admin']){
			view('backend/orders/index', [
				'address' => $address,
				'product' => $product,
				'orders'  => $orders,
				'user'  => $user
			]);
		}else{
			view('backend/orders/orders', [
				'address' => $address,
				'product' => $product,
				'orders'  => $orders,
				'user'  => $user
			]);
		}
		

		
	}




/* 	public function getUsers()
	{	
				
		$users 	= User::all();		
		view('backend/users/index', [
				'users' => $users
			]
		); 
	} */

 	public function getAllusers()
	{			
		$users 	= Order::with('users')->get();  		
	} 



	public function getInvoice($id = NULL) 
	{
		if ($id != NULL) {
			
			$dompdf = new Dompdf();

			$order 	= Order::with('products')->find($id); 

			include_once BASE_URL . '/views/backend/orders/invoice.php';

			$dompdf->loadHtml($html);
			
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream();
		}

		redirect('/dashboard/orders');
	}
}