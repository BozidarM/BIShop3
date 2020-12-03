<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\ProductController;
use app\controllers\UserController;
use app\controllers\CartController;
use app\core\Application;

$app = new Application();

$app->router->get("/", [HomeController::class, 'dashboard']);
$app->router->get("/index", [HomeController::class, 'dashboard']);
$app->router->get("/accessDenied", 'accessDenied');
$app->router->get("/home", [HomeController::class, 'dashboard']);

// CHART JS -----------------
$app->router->get("/mostBuys", [ProductController::class, 'mostBuys']); 
$app->router->get("/mostSelling", [ProductController::class, 'mostSelling']); 
$app->router->get("/worstSelling", [ProductController::class, 'worstSelling']); 
$app->router->get("/ordersOverTime", [ProductController::class, 'ordersOverTime']); 
$app->router->get("/activeUsers", [ProductController::class, 'activeUsers']); 

$app->router->get("/products", [ProductController::class, 'products']);
$app->router->get("/productDetails", [ProductController::class, 'details']);
$app->router->get("/productsJSON", [ProductController::class, 'productsJSON']);
$app->router->get("/productEdit", [ProductController::class, 'edit']);
$app->router->get("/productDelete", [ProductController::class, 'delete']);
$app->router->get("/productCreate", [ProductController::class, 'create']);
$app->router->post("/productCreate", [ProductController::class, 'create']);
$app->router->post("/productCreateProcess", [ProductController::class, 'createProcess']);
$app->router->get("/productEdit", [ProductController::class, 'edit']);
$app->router->post("/productEdit", [ProductController::class, 'edit']);
$app->router->post("/productEditProcess", [ProductController::class, 'editProcess']);
$app->router->post("/importProductJsonProcess", [ProductController::class, 'importJsonProcess']);

$app->router->get("/cart", [CartController::class, 'cart']);
$app->router->get("/addToCart", [CartController::class, 'addToCart']);
$app->router->post("/addToCart", [CartController::class, 'addToCart']);
$app->router->get("/removeFromCart", [CartController::class, 'removeFromCart']);
$app->router->post("/removeFromCart", [CartController::class, 'removeFromCart']);
$app->router->get("/checkout", [CartController::class, 'checkout']);

$app->router->get("/profile", [UserController::class, 'profile']);
$app->router->get("/login", [AuthController::class, 'login']);
$app->router->get("/register", [AuthController::class, 'register']);
$app->router->get("/logout", [AuthController::class, 'logout']);
$app->router->post("/loginProcess", [AuthController::class, 'loginProcess']);
$app->router->post("/profileUpdate", [UserController::class, 'profileUpdate']);
$app->router->post("/registerProcess", [AuthController::class, 'registerProcess']);
$app->router->post("/updateUserData", [UserController::class, 'profileUpdate']);

$app->run();


