<?php 

namespace App\Controllers\Backend;

use App\Models\Brand;
use App\Helpers\ValidatorFactory;

class BrandController
{
	public function getIndex()
	{
		$brands = Brand::all();

		view('backend/brands/index', ['brands' => $brands]);
	}

	public function getCreate()
	{
		view('backend/brands/create');
	}

	public function postStore()
	{
		$name = $_POST['name'];
		$slug = createSlug($_POST['slug']);

		$validator = (new ValidatorFactory())->make(
		    $data = [
		    	'name' 	=> $name,
		    	'slug' 	=> $slug,
		    ],
		    $rules = [
		    	'name' 	=> 'required|max:255',
		    	'slug' 	=> 'required|max:255'
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['validator-errors'] = $validator->errors()->all();

			redirect('/dashboard/brands/create');
		}
		
		$active = isset($_POST['active']) ? true : false;

		try {
			$brand = Brand::create([
				'name' 		=> $name,
				'slug' 		=> $slug,
				'active' 	=> $active
			]);

			$_SESSION['error'] 				= NULL;
			$_SESSION['validator-errors'] 	= NULL;
			$_SESSION['success'] 			= 'Brand created successfully.'; 
	
			redirect('/dashboard/brands');

		} catch (\Exception $e) {

			$_SESSION['success'] = NULL;
			$_SESSION['error'] 	 = $e->getMessage();

			redirect('/dashboard/brands/create');
		}
	}

	public function getEdit($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/brands');
		}

		$brand = Brand::find($id);

		view('backend/brands/edit', ['brand' => $brand]);
	}

	public function postUpdate()
	{
		$id   = $_POST['id'];
		$name = $_POST['name'];
		$slug = createSlug($_POST['slug']);

		$validator = (new ValidatorFactory())->make(
		    $data = [
		    	'name' 	=> $name,
		    	'slug' 	=> $slug,
		    ],
		    $rules = [
		    	'name' 	=> 'required|max:255',
		    	'slug' 	=> 'required|max:255'
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['validator-errors'] = $validator->errors()->all();

			redirect('/dashboard/brands/edit/'.$id);
		}
		
		$active = isset($_POST['active']) ? true : false;

		$brand = Brand::find($id);

		$brand->update([
			'name' 		=> $name,
			'slug' 		=> $slug,
			'active' 	=> $active
		]);

		$_SESSION['success'] = 'Brand updated successfully.'; 

		redirect('/dashboard/brands');
	}

	public function getDelete($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/brands');
		}

		$brand = Brand::find($id);
		$brand->delete();

		$_SESSION['success'] = 'Brands deleted successfully.'; 

		redirect('/dashboard/brands');
	}
}