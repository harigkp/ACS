<?php 

namespace App\Controllers\Backend;

use App\Models\User;
use App\Helpers\ValidatorFactory;


class UserController
{
	public function getIndex()
	{
		$users 	= User::all();
		
		view('backend/users/index', [
				'users' => $users
			]
		); 
	}


	public function getallusers()
	{
		$users 	= User::all();
		
		view('backend/users/users', [
				'users' => $users
			]
		); 
		
	}




	public function getEdit($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/users');
		}
		$user = User::find($id);
		
		view('backend/users/edit', ['user' => $user]);
	}




	public function getCreate()
	{
		
		view('backend/users/create');
	}

		public function postRegister()
	{
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];

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

			redirect('dashboard/users/create');
		}

		try {
			
			$active = isset($_POST['active']) ? true : false;
			$user = User::create([
				'name' 						=> $name,
				'email' 					=> $email,
				'password' 					=> password_hash($password, PASSWORD_DEFAULT),
				'active' 					=> 0,
				'email_verification_token' 	=> '',
				'active' 	=> $active
				
			]);
			redirect('dashboard/users');

		} catch (\Exception $e) {

			$_SESSION['success'] 			= NULL;
			$_SESSION['validate-name'] 		= NULL;
			$_SESSION['validate-email'] 	= NULL;
			$_SESSION['validate-password'] 	= NULL;
			$_SESSION['error'] 				= 'Email address is already taken!';

			redirect('dashboard/users/create');
		}
	}



	public function postUpdate()
	{
		
		$id 		= $_POST['id'];
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		if($_POST['password']<>""){
			$password 	= $_POST['password'];

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

						redirect('/dashboard/users/edit/'.$id);
					}
					
				try {
					
					$active = isset($_POST['active']) ? true : false;
					$user = User::find($id);
					
					$user->update([
						'name' 						=> $name,
						'email' 					=> $email,
						'password' 					=> password_hash($password, PASSWORD_DEFAULT),
						'active' 					=> 0,
						'email_verification_token' 	=> '',
						'active' 	=> $active
						
					]);
					redirect('/dashboard/users/');

				} catch (\Exception $e) {

					$_SESSION['success'] 			= NULL;
					$_SESSION['validate-name'] 		= NULL;
					$_SESSION['validate-email'] 	= NULL;
					$_SESSION['validate-password'] 	= NULL;
					$_SESSION['error'] 				= 'Email address is already taken!';

					redirect('/dashboard/users/edit/'.$id);
				}					
					
					
					
					
					
		}else{

					$validator = (new ValidatorFactory())->make(
						$data = [
							'name' 		=> $name,
							'email' 	=> $email,
						],
						$rules = [
							'name' 		=> 'required|min:3',
							'email' 	=> 'required|email',
						]
					);

					if ($validator->fails()) {

						$_SESSION['validate-name'] 		= $validator->errors()->get('name');
						$_SESSION['validate-email'] 	= $validator->errors()->get('email');

						redirect('/dashboard/users/edit/1');
					}	

				try {
					
					$active = isset($_POST['active']) ? true : false;
					$user = User::find($id);
					
					$user->update([
						'name' 						=> $name,
						'email' 					=> $email,
						'active' 					=> 0,
						'email_verification_token' 	=> '',
						'active' 	=> $active
						
					]);
					redirect('/dashboard/users/');

				} catch (\Exception $e) {

					$_SESSION['success'] 			= NULL;
					$_SESSION['validate-name'] 		= NULL;
					$_SESSION['validate-email'] 	= NULL;
					$_SESSION['error'] 				= 'Email address is already taken!';

					redirect('/dashboard/users/edit/1');
				}					
			
		}


	}

	public function getDelete($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/users');
		}

		$iuser = User::find($id);
		$user->delete();

		$_SESSION['success'] = 'user deleted successfully.'; 

		redirect('/dashboard/users');
	}
	
	
	
	
}