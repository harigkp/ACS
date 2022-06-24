<?php 

namespace App\Controllers\Frontend;



use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

use App\Helpers\ValidatorFactory;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Pagination\Paginator;
use Firebase\JWT\JWT;


class HomeController
{
	
 
	public function getIndex()
	{ 
		
		$sliders  = Product::where('active_on_slider',true)->get();
		$products = Product::where('active',true)->paginate(8);

		view('index', ['sliders' => $sliders, 'products' => $products]);
	}

	public function getProduct($slug = NULL) 
	{
		if($slug == NULL) {
			redirect('/');
		}

		$product = Product::with('images')->where('slug',$slug)->first();

		if(empty($product)) {

			redirect('/');

		} else {

			view('product', ['product' => $product]);
		}
		
	}

	public function getProductlist()
	{
		
		if(isset($_POST['brand'])){
			
			$products 	= Product::where('active',true)->where('brand_id','=',$_POST['brand'])->get();
		
		}elseif(isset($_POST['gender'])){
			
			$products 	= Product::where('active',true)->where('gender','=',$_POST['gender'])->get();
			
			
		}elseif(isset($_POST['size'])){
			
			$products 	= Product::where('active',true)->where('size','=',$_POST['size'])->get();
			
			
		}


		
		
		if (isset($_GET['search']) && ($_GET['search'] != NULL)) {

			$search 	= $_GET['search'];
			$products 	= Product::where('active',true)->where('title','LIKE','%'.$search.'%')->get();

		} elseif (isset($_GET['category']) && ($_GET['category'] != NULL)) {

			$slug 		= $_GET['category'];
			$category	= Category::with('products')->where('slug',$slug)->get(); //die($category);
			$products 	= $category[0]->products; 

		} else {
			$perPage = 6;
			$products 	= Product::where('active',true)->paginate($perPage);
			//echo $totalPageNumber = $products->count();
			$updatedItems = $products->getCollection();
			
			$products->setCollection(collect($updatedItems));
			
			$pagination = new Paginator($products, $perPage);
		}

		$categories = Category::withCount('products')->get();
		$brands  = Brand::where('active',1)->get();
		
		view('product-list', ['categories' => $categories, 'products' => $products, 'pagination' => $pagination, 'brands' => $brands]);
	}


	// LOGIN
	public function getLogin()
	{
		if (@$_SESSION['login']) {
			redirect('/dashboard');
		}

		view('auth/login');
	}	

	public function postLogin()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: access");
		header("Access-Control-Allow-Methods: POST");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		
		
		
		
		$email 		= trim($_POST['email']);
		$password 	= trim($_POST['Password']);

		$validator = (new ValidatorFactory())->make(
		    $data = [
		    	'email' 	=> $email,
		    	'password' 	=> $password,
		    ],
		    $rules = [
		    	'email' 	=> 'required|email',
		    	'password' 	=> 'required|min:6'
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['login-email-error'] 		= $validator->errors()->get('email');
			$_SESSION['login-password-error'] 	= $validator->errors()->get('password');

			$outputdata = array( 'code' => '200','message' => 'Given credentials not match in our database.');							
			echo json_encode($outputdata);die;
		}

		$user = User::where('email', $email)->first();

		if ($user) {

			$_SESSION['login']  				= false;
			$_SESSION['success']  				= NULL;
			$_SESSION['error']  				= NULL;
			$_SESSION['mailsend']  				= NULL;
			$_SESSION['login-email-error']		= NULL;
			$_SESSION['login-password-error']	= NULL;

			if (md5($password) == $user->password) {
			    
			    if (($user->email_verified_at == NULL) && ($user->email_verification_token != NULL)) {
			    	
					$_SESSION['error']  	= 'Email account not verified.';

					$outputdata = array( 'code' => '200','message' => $_SESSION['error']);							
			        echo json_encode($outputdata);die;

			    } else {

			    	$_SESSION['success']  	= 'Welcome '.$user->name.'.';
			    	$_SESSION['userid']  	= $user->id;
					$_SESSION['admin']  	= $user->admin;
					$_SESSION['uname']  	 = $user->name;
			    	$_SESSION['login']  	= true;

					$secret_key  = md5($user->name.$user->id);
					$issuer_claim = 'http://localhost/'; 
					$audience_claim = $user->name;
					$issuedat_claim = time(); // issued at
					$notbefore_claim = $issuedat_claim + 10; //not before in seconds
					$expire_claim = $issuedat_claim + 240; // expire time in seconds
					$token = array(
							"iss" => $issuer_claim,
							"aud" => $audience_claim,
							"iat" => $issuedat_claim,
							"nbf" => $notbefore_claim,
							"exp" => $expire_claim,
							"data" => array(
								"id" =>  $user->id,
								"name" => $user->name,
								"admin" => $user->admin
								)
							);
                    http_response_code(200);				
					$jwt = JWT::encode($token, $secret_key,'HS256');
                    $returnData = [
					    'code' => 200,
                        'admin' => $user->admin,
						'success' => 1,
                        'message' => 'Successful login',
                        'token' => $jwt
                    ];
                    $_SESSION['jwttoken']  	= $jwt;
			    	//redirect('/dashboard');
					$outputdata = array( 'code' => '200','message' => 'Successful login@@admin='.$user->admin);							
			        echo json_encode($outputdata);die;					
			    }

			} else {

				$_SESSION['error']  = 'Invalid password.';
				$outputdata = array( 'code' => '200','message' => $_SESSION['error']);							
			    echo json_encode($outputdata);die;
			}

		} else {

			$_SESSION['login-email-error']		= NULL;
			$_SESSION['login-password-error']	= NULL;
			$_SESSION['login']  				= false;
			$_SESSION['success']				= NULL;
			$_SESSION['error']  				= 'Invalid credentials.';

			$outputdata = array( 'code' => '200','message' => $_SESSION['error']);							
			echo json_encode($outputdata);die;
		}

	}


    function getCheckuser(){
       ob_start();
       @session_start();
	   
       require 'vendor/autoload.php';
       $headers = apache_request_headers();	 
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: access");
		header("Access-Control-Allow-Methods: GET");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		




    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }


	$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

		if ($authHeader=='') {
			$allHeaders = getallheaders();
			$authHeader = isset($allHeaders['Authorization']) ? $allHeaders['Authorization'] : false;
		}

		if($authHeader==""){
			$jwt = $_SESSION['jwttoken'];		
		}else{
			$arr = explode(" ", $authHeader);
			$jwt = $arr[1];
		}
	
	\Firebase\JWT\JWT::$leeway = 20;

	$secret_key  = md5($_SESSION['uname'].$_SESSION['userid']);
	
//echo "------".$decoded->data->id.'-----jwt--'.$jwt;

try { 
                 $decoded = JWT::decode($jwt, $secret_key,array('HS256'));
      /* Refresh Token */
					
					$issuer_claim = 'http://localhost/'; 
					$audience_claim = $_SESSION['uname'];
					$issuedat_claim = time(); // issued at
					$notbefore_claim = $issuedat_claim + 10; //not before in seconds
					$expire_claim = $issuedat_claim + 240; // expire time in seconds
					$token = array(
							"iss" => $issuer_claim,
							"aud" => $audience_claim,
							"iat" => $issuedat_claim,
							"nbf" => $notbefore_claim,
							"exp" => $expire_claim,
							"data" => array(
								"id" =>  $_SESSION['userid'],
								"name" => $_SESSION['uname'],
								"admin" => $_SESSION['admin']
								)
							);
                    http_response_code(200);				
					$jwt = JWT::encode($token, $secret_key,'HS256');
                    $returnData = [
					    'code' => 200,
                        'admin' => $_SESSION['admin'],
						'success' => 1,
                        'message' => 'Successful login',
                        'token' => $jwt
                    ];
                    $_SESSION['jwttoken']  	= $jwt;
					
					
	
	               /* End refresh Token */	
       $outputdata = array( 'code' => '200','message' => 'Refresh Token.');							
	   echo json_encode($outputdata);die;
} 
catch (\Firebase\JWT\ExpiredException $e) { 

		unset($_SESSION['login']);
		unset($_SESSION['userid']);
		unset($_SESSION['jwttoken']);

		$_SESSION['success'] 	= 'You have been logout.';
		$_SESSION['error'] 		= NULL;
        $outputdata = array( 'code' => '401','message' => 'Logout.');							
	    echo json_encode($outputdata);die;
}

	
	
	 
 }



	public function getRegister()
	{
		if (@$_SESSION['login']) {
			redirect('/dashboard');
		}
		
		view('auth/register');
	}



	public function postRegister()
	{
		

		$name 		= $_POST['username'];
		$email 		= $_POST['email'];
		$password 	= $_POST['Password'];
		$token 		= randomString();

		$validator = (new ValidatorFactory())->make(
		    $data = [
		    	'name' 		=> $name,
		    	'email' 	=> $email,
		    	'password' 	=> $password,
		    ],
		    $rules = [
		    	'name' 		=> 'required|min:3',
		    	'email' 	=> 'required|email',
		    	'password' 	=> 'required|min:6'
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['validate-name'] 		= $validator->errors()->get('name');
			$_SESSION['validate-email'] 	= $validator->errors()->get('email');
			$_SESSION['validate-password'] 	= $validator->errors()->get('password');

			$outputdata = array( 'code' => '200','message' => 'Please check data as you filled.');							
			echo json_encode($outputdata);die;
		}

		try {
			$user = User::create([
				'name' 						=> $name,
				'email' 					=> $email,
				'password' 					=> md5($password),
				'active' 					=> 0,
				'email_verification_token' 	=> $token
			]);

			$mail = new PHPMailer(true);                  
			try {
				//Server settings
				$mail->SMTPDebug 	= 2;                           
				$mail->isSMTP();                                
				$mail->Mailer = "smtp";
                $mail->Host = "smtp.gmail.com";		
				$mail->SMTPAuth 	= true;                         
				$mail->Username 	= 'hari.phpexpert@gmail.com';            
				$mail->Password 	= 'tttttt';             
				$mail->SMTPSecure 	= 'ssl';             			
				$mail->Port 		= 587;                    			
	
				//Recipients
				$mail->setFrom('hari.phpexpert@gmail.com', 'Mailer');
				$mail->addAddress($email, $name);  
	
				$httphost = $_SERVER['HTTP_HOST']; // Temporary
				//Content
				$mail->isHTML(true);                          
				$mail->Subject = "Verify you email account";
				$mail->Body    = "Dear $name, <br><br>Please active your account by click link: <br><a href='http://$httphost/active/$token'>Active Your Account.</a>";
				$mail->AltBody = "Please active you account by using the link: http://$httphost/active/$token";

				$mail->send();
	
			} catch (Exception $e) {
				// echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

				$_SESSION['success'] 			= NULL;
				$_SESSION['validate-name'] 		= NULL;
				$_SESSION['validate-email'] 	= NULL;
				$_SESSION['validate-password'] 	= NULL;
				$_SESSION['error'] 				= 'Account activation message could not be sent. '.$mail->ErrorInfo;
	
				$outputdata = array( 'code' => '200','message' => $_SESSION['error']);							
			    echo json_encode($outputdata);die;
				
				
				//redirect('/register');
			}

			$_SESSION['mailsend'] 			= 'Activation mail has been sent.';
			$_SESSION['success']  			= 'Registration completed successfully.';
			$_SESSION['error'] 				= NULL;
			$_SESSION['validate-name'] 		= NULL;
			$_SESSION['validate-email'] 	= NULL;
			$_SESSION['validate-password'] 	= NULL;

			$outputdata = array( 'code' => '200','message' => $_SESSION['mailsend'].'@@'.$_SESSION['success']);							
			echo json_encode($outputdata);die;
			
			
			
			
			//redirect('/login');

		} catch (\Exception $e) {

			$_SESSION['success'] 			= NULL;
			$_SESSION['validate-name'] 		= NULL;
			$_SESSION['validate-email'] 	= NULL;
			$_SESSION['validate-password'] 	= NULL;
			$_SESSION['error'] 				= 'Email address is already taken!';
			
			$outputdata = array( 'code' => '200','message' => 'Email address is already taken!');							
			echo json_encode($outputdata);die;

			//redirect('/register');
		}
	}

	public function getActive($active = '')
	{
		$user = User::where('email_verification_token', $active)->first();

		if ($user) {
			
			$user->update([
				'email_verified_at' 		=> Carbon::now(),
				'email_verification_token' 	=> NULL,
				'active' 					=> 1
			]);

			$_SESSION['mailsend'] 	= NULL;
			$_SESSION['error'] 		= NULL;
			$_SESSION['success']  	= 'Account activated successfully.';

			redirect('/login');

		} else {

			$_SESSION['mailsend'] 	= NULL;
			$_SESSION['success']  	= NULL;
			$_SESSION['error']  	= 'Incorrect activation token.';

			redirect('/login');
		}
	}

	public function getLogout()
	{
		unset($_SESSION['login']);
		unset($_SESSION['userid']);
		unset($_SESSION['jwttoken']);

		$_SESSION['success'] 	= 'You have been logout.';
		$_SESSION['error'] 		= NULL;

		redirect('/login');
	}



	/*
	 *	Encode array into JSON
	*/
	public function json($data){
		if(is_array($data)){
			//return json_encode($data, JSON_UNESCAPED_SLASHES);
			return json_encode($data);
		}
	}



}