<?php 
define('BASE_URL', __DIR__);
use Phroute\Phroute\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
require_once 'vendor/autoload.php';

 
 $capsule = new Capsule;
 
 $capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'composerecom',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent(); 


define('BASE', 'http://'.$_SERVER['HTTP_HOST']);


