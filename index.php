<?php 


require_once 'config.php';

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteParser;
use Phroute\Phroute\RouteCollector;

use App\Controllers\Frontend\CartController;
use App\Controllers\Frontend\HomeController;

use App\Controllers\Backend\ProductController;
use App\Controllers\Backend\CategoryController;
use App\Controllers\Backend\CheckoutController;
use App\Controllers\Backend\DashboardController;
use App\Controllers\Backend\UserController;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;



//define('BASE_URL', __DIR__);

session_start();

$router = new RouteCollector();
$homec = new HomeController();

$router->controller('/', HomeController::class);

 $router->filter('auth', function() {    
    if(!isset($_SESSION['login'])) {
        header('Location: /login');
        return false;
    }
});
$router->controller('/cart', CartController::class);
$router->group(['before' => 'auth'], function(RouteCollector $router){
    $router->controller('/checkout', CheckoutController::class);
});

$router->group(['prefix' => 'dashboard', 'before' => 'auth'], function(RouteCollector $router){
    $router->controller('/', DashboardController::class);
    $router->controller('/categories', CategoryController::class);
    $router->controller('/products', ProductController::class);
	$router->get('/products/store', function () {
        
         return '';
     });

});




/* $router->group(['prefix' => 'dashboard', 'before' => 'auth'], function(RouteCollector $router){
	     $router->controller('/products/store', ProductController::function);
         $pcontroller = new ProductController();
         $content = $pcontroller->store();
        // return $content;
}); */
//$router->controller('/user/allusers', UserController::class->getallusers());

$router->get('/user/allusers', function () {
         $ucontroller = new UserController();
         $content = $ucontroller->getallusers();
         return $content;
     });


$router->get('/auth', function () {
         $hcontroller = new HomeController();
         $content = $hcontroller->getCheckuser();
         return $content;
     });


/* $router->get('/dashboard/orders', function () {
         $docontroller = new DashboardController();
         $order_content = $docontroller->getOrders();
         return $order_content;
     }); */





//$router->controller('prefix' => 'api/cart', CartController::class);

$dispatcher =  new Dispatcher($router->getData());





try {
	
	$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	

} catch (HttpRouteNotFoundException $e) {
	echo $e->getMessage();
	die();
} catch (HttpMethodNotAllowedException $e) {
	echo $e->getMessage();
	die();
}
    
echo $response;