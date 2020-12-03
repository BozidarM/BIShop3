<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Application;
use app\core\DBConnection;
use app\models\ProductModel;
use app\models\DBModel;

class CartController extends Controller {
    
    public function addToCart() 
    {
        if(Application::$app->session->addToCart()){
            echo count(Application::$app->session->get('cart'));
        }else{
            echo -1;
        }
    }

    public function removeFromCart() 
    {
        $product_id = $_GET['product_id'];

        Application::$app->session->removeFromCart($product_id);

        if (count(Application::$app->session->allInCart()) == 0)
            Application::$app->session->destroyCart();

        Application::$app->response->redirect("/cart");
    }

    public function allInCart() 
    {
        return Application::$app->session->allInCart();
    }

    /**
     * Cart - get method
     */
    public function cart()
    {
        $model = new ProductModel();

        $dbData = $model->all();

        echo $this->view("cart", "main", $dbData);
    }

    public function checkout()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);
        
        if (!isset($_SESSION['cart']))
        {
            Application::$app->session->setFlash('errors', "No items in your cart.");
            Application::$app->response->redirect("/cart");
            return;
        }
        $products = [];
        foreach($_SESSION['cart'] as $item)
            $products[] = $item;
        $user = $_SESSION['user']->{'user_id'};

        $modelConn = new DBConnection();
        $db = $modelConn->conn();

        if($this->createFullOrder($products, $user, $db))
        {
            Application::$app->session->destroyCart();
            Application::$app->session->setFlash('order_placed', "Your order is successfully placed!");
        }

        echo $this->view("home", "main", null);
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function createMultipleOrderItem($products, $orderId, $db)
    {
        $sqlString = "INSERT INTO `order_items` (`order_id`, `product_id`) VALUES ";

        foreach($products as $product => $val)
        {
            $sqlString = $sqlString . "('$orderId'," . $val['id'] . "),";
        }

        $sqlString = substr_replace($sqlString, ";", -1);

        $db->query($sqlString) or die();

        return true;
    }

    public function createOrder($userId, $db)
    {
        $sqlString = "INSERT INTO `order` (`user_id`) VALUES ($userId)";

        $db->query($sqlString) or die();

        return true;
    }

    public function lastAddedOrder($db){
        $sqlString = "SELECT `order_id` FROM `order` ORDER BY `order_id` DESC LIMIT 1";

        $dbData = $db->query($sqlString) or die();

        $lastAddedOrder = $dbData->fetch_assoc();

        return intval($lastAddedOrder['order_id']);
    }

    public function createFullOrder($products, $userId, $db)
    {
        $this->createOrder($userId, $db);

        $orderId = $this->lastAddedOrder($db);

        $result = $this->createMultipleOrderItem($products, $orderId, $db);

        return $result;
    }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    public function athorize()
    {
        return [
            "Admin",
            "User",
            "Guest"
        ];
    }
}

?>