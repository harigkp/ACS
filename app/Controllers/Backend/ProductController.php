<?php 

namespace App\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Helpers\ValidatorFactory;

class ProductController 
{
    public function getIndex() 
    {
        $products = Product::all();

        view('backend/products/index', ['products' => $products]);
    }


   public function getProductbyid() 
    {
        $products = Product::all();

        view('backend/products/index', ['products' => $products]);
    }


    public function getCreate()
    {
        $categories = Category::all(); 
		$brands = Brand::all(); 

        view('backend/products/create', ['categories' => $categories, 'brands' => $brands]);
    }

	public function postStore()
	{ 
		
		$title          = $_POST['title'];
		$categoryid     = $_POST['category_id'];
		$brandid        = $_POST['brand_id'];
		$description    = $_POST['description'];
		$price          = $_POST['price'];
		$saleprice      = $_POST['sale_price'];
		$slug           = createSlug($_POST['title']);
		$size           = $_POST['size'];
		$gender         = $_POST['gender'];
		$image      	= $_FILES['image'];

		$validator = (new ValidatorFactory())->make(
		    $data = [
		    	'title' 	    => $title,
		    	'category_id' 	=> $categoryid,
				'brand_id' 	    => $brandid,
		    	'description' 	=> $description,
		    	'price' 	    => $price,
				'sale_price' 	=> $saleprice,
				'size'          => $size,
				'gender'        => $gender,			
				// 'image'			=> $image['name']
		    ],
		    $rules = [
		    	'title' 	    => 'required|max:255',
		    	'category_id' 	=> 'required',
				'brand_id' 	    => 'required',
		    	'description' 	=> 'required',
		    	'price' 	    => 'required',
		    	'sale_price' 	=> 'required',
		    	'size' 	        => 'required',
		    	'gender' 	    => 'required',				
		    	// 'image' 		=> 'required|image'
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['validator-errors'] = $validator->errors()->all();

			$outputdata = array( 'code' => '500','message' => 'something wrong');							
			echo json_encode($outputdata);die;
			
			
			//redirect('/dashboard/products/create');
		}
		
		$imgrandname 	= 'product-'.time();
		$imageext 	 	= explode('.', $image['name']);
		$extension 	 	= end($imageext);
		$imagename	 	= 'assets/images/products/' . $imgrandname . '.' . strtolower($extension);

		move_uploaded_file($image['tmp_name'], $imagename);

		$active 		= isset($_POST['active']) ? true : false;
        $activeonslider = isset($_POST['active_on_slider']) ? true : false;

		try {
			$product = Product::create([
				'title' 	    	=> $title,
		    	'category_id' 		=> $categoryid,
				'brand_id' 		    => $brandid,
		    	'description' 		=> $description,
		    	'price' 	    	=> $price,
		    	'sale_price' 		=> $saleprice,
				'size' 		        => $size,
				'gender' 		    => $gender,
				'slug' 		   	 	=> $slug,
				'image' 			=> $imagename,
				'active_on_slider'	=> $activeonslider,
				'active' 	    	=> $active
			]);

			$gallery 		= $_FILES["gallery"];
			$galleryimage 	= $this->productGallery($gallery);

			$product->images()->createMany($galleryimage);

			$_SESSION['error'] 				= NULL;
			$_SESSION['validator-errors'] 	= NULL;
			$_SESSION['success'] 			= 'Product created successfully.'; 

			//redirect('/dashboard/products');
			
			$outputdata = array( 'code' => '200','message' => $_SESSION['success']);							
			echo json_encode($outputdata);die;

		} catch (\Exception $e) {

			$_SESSION['success'] = NULL;
			$_SESSION['error'] 	 = $e->getMessage();

			//redirect('/dashboard/products/create');
			$outputdata = array( 'code' => '500','message' => 'something wrong');							
			echo json_encode($outputdata);die;
		}
	}

	public function getEdit($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/products');
		}

		$categories = Category::all();
		$brands     = Brand::all();
		$product    = Product::with('images')->find($id);

		view('backend/products/edit', ['categories' => $categories, 'product' => $product,'brands' => $brands]);
    }
    
    public function postUpdate()
	{
        
		$id             = $_POST['id']; 
		$title          = $_POST['title'];
		$categoryid     = $_POST['category_id'];
		$brandid        = $_POST['brand_id'];
		$description    = $_POST['description'];
		$price          = $_POST['price'];
		$saleprice      = $_POST['sale_price'];
		$size           = $_POST['size'];
		$gender         = $_POST['gender'];		

		$slug           = createSlug($_POST['title']);
		$image      	= $_FILES['image'];

		$validator = (new ValidatorFactory())->make(
		    $data = [
		    	'title' 	    => $title,
		    	'category_id' 	=> $categoryid,
				'brand_id' 	    => $brandid,
		    	'description' 	=> $description,
		    	'price' 	    => $price,
		    	'sale_price' 	=> $saleprice,
				'size'          => $size,
				'gender'        => $gender,
		    ],
		    $rules = [
		    	'title' 	    => 'required|max:255',
		    	'category_id' 	=> 'required',
				'brand_id' 	    => 'required',
		    	'description' 	=> 'required',
		    	'price' 	    => 'required',
		    	'sale_price' 	=> 'required',
			    'size' 	        => 'required',
		    	'gender' 	    => 'required',
		    ]
		);

		if ($validator->fails()) {

			$_SESSION['validator-errors'] = $validator->errors()->all();

           $outputdata = array( 'code' => '500','message' => 'something wrong');							
			echo json_encode($outputdata);die;

			//redirect('/dashboard/products/edit/'.$id);
		}
		
        $active 		= isset($_POST['active']) ? true : false;
        $activeonslider = isset($_POST['active_on_slider']) ? true : false;
        
		$product = Product::find($id);
		
		if( !empty($image['name']) ) {

			if(file_exists($product->image)) {
				unlink($product->image);
			}

			$imgrandname 	= 'product-'.time();
			$imageext 	 	= explode('.', $image['name']);
			$extension 	 	= end($imageext);
			$imagename	 	= 'assets/images/products/' . $imgrandname . '.' . strtolower($extension);

			move_uploaded_file($image['tmp_name'], $imagename);

		} else {
			$imagename = $product->image;
		}

        $product->update([
            'title' 	    	=> $title,
            'category_id' 		=> $categoryid,
			'brand_id' 		    => $brandid,
            'description' 		=> $description,
            'price' 	    	=> $price,
            'sale_price' 		=> $saleprice,
            'size' 		        => $size,
            'gender' 		    => $gender,			
            'slug' 		    	=> $slug,
            'image' 			=> $imagename,
            'active_on_slider'	=> $activeonslider,
            'active' 	    	=> $active
		]);
		
		$gallery 		= $_FILES["gallery"];
		$galleryimage 	= $this->productGallery($gallery);
		$product->images()->createMany($galleryimage);

        $_SESSION['error'] 				= NULL;
        $_SESSION['validator-errors'] 	= NULL;
        $_SESSION['success'] 			= 'Product updated successfully.'; 
		
		$outputdata = array( 'code' => '200','message' => $_SESSION['success']);							
		echo json_encode($outputdata);die;

        //redirect('/dashboard/products');
    }

	public function getDelete($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/products');
		}

		$product = Product::with('images')->find($id);

		if(file_exists($product->image)) {
			unlink($product->image);
		}


		foreach ($product->images as $gallery) {
			if(file_exists($gallery->image)) {
				unlink($gallery->image);
			}
		}
		$product->images()->delete();
		
		$product->delete();

		$_SESSION['success'] = 'Product deleted successfully.'; 

		$outputdata = array( 'code' => '200','message' => $_SESSION['success']);							
		echo json_encode($outputdata);die;
	}

	public function getGalleryDelete($id = null)
	{
		if ($id == null) {
			redirect('/dashboard/products');
		}

		$galleryimg = ProductImage::find($id);

		if(file_exists($galleryimg->image)) {
			unlink($galleryimg->image);
		}
		$galleryimg->delete();

		redirect('/dashboard/products/edit/'.$galleryimg->product_id);
	}

		
	protected function productGallery($gallery)
	{
		if($gallery) {
			
			$galleryimage = [];

			foreach($gallery["tmp_name"] as $key => $tmp_name) {

				$file_name 	= $gallery["name"][$key];
				$ext 		= pathinfo($file_name,PATHINFO_EXTENSION);
				$newname	= 'gallery-'.md5(uniqid()).'-'.time().'.'.strtolower($ext);

				$validextensions = array("jpeg", "jpg", "png");
			
				if(in_array($ext,$validextensions)) {

					move_uploaded_file($gallery["tmp_name"][$key],"assets/images/productgallery/".$newname);

					$galleryimage[]['image'] = "assets/images/productgallery/" . $newname;
				}
				else {
					$_SESSION['error'] = 'Not valid gallery image type!';
				}
			}
		}

		return $galleryimage;
	}
}