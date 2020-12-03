<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Application;
use app\core\DBConnection;
use app\models\ProductModel;

class ProductController extends Controller
{
    /**
     * List of all products - get method
     */
    public function products()
    {
        $model = new ProductModel();

        $dbData = $model->all();

        echo $this->view("products", "main", $dbData);
    }

    public function productsJSON()
    {
        $model = new ProductModel();

        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");
        $numberOfPage = $this->request->getOne("numberOfPage");
        $sortByDate = $this->request->getOne("sortByDate");
        $sortByPrice = $this->request->getOne("sortByPrice");

        $dbData = $model->productsLoadMore($numberOfPage, $numberOfRows, $search, $sortByDate, $sortByPrice);

        echo json_encode($dbData);
    }

    // MOST BUYS CHART JS
    public function mostBuys()
    {
        $roles = ["Admin"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $dateFrom = $_GET['dateFrom'] ?? date('Y-m-d', '2020-01-01');
        $dateTo = $_GET['dateTo'] ?? date('Y-m-d', time());

        if ($dateFrom > $dateTo)
        {
            $dateFrom = date('Y-m-d', '2020-01-01');
            $dateTo = date('Y-m-d', time());
        }
        
        $db = new DBConnection();
        $db = $db->conn();

        $sqlString = "SELECT `user_id`, COUNT(`user_id`) AS 'number_of_orders' FROM `order` 
        WHERE `ordered_at` BETWEEN '$dateFrom' AND '$dateTo'
        GROUP BY `user_id` ORDER BY number_of_orders DESC LIMIT 10;";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        echo json_encode($resultArray);
    }

    // BEST SELLING PRODUCTS CHART JS
    public function mostSelling()
    {
        $roles = ["Admin"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $dateFrom = $_GET['dateFrom'] ?? date('Y-m-d', '2020-01-01');
        $dateTo = $_GET['dateTo'] ?? date('Y-m-d', time());

        if ($dateFrom > $dateTo)
        {
            $dateFrom = date('Y-m-d', '2020-01-01');
            $dateTo = date('Y-m-d', time());
        }
        
        $db = new DBConnection();
        $db = $db->conn();

        $sqlString = "SELECT `order_items`.`product_id` AS 'product_id', COUNT(`order_items`.`product_id`) AS 'times_ordered' 
        FROM `order_items`
        INNER JOIN `order` ON `order`.`order_id` = `order_items`.`order_id` 
        WHERE `order`.`ordered_at` BETWEEN '$dateFrom' AND '$dateTo'
        GROUP BY `order_items`.`product_id`
        ORDER BY times_ordered DESC
        LIMIT 10";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        echo json_encode($resultArray);
    }

    // WORST SELLING PRODUCTS CHART JS
    public function worstSelling()
    {
        $roles = ["Admin"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $dateFrom = $_GET['dateFrom'] ?? date('Y-m-d', '2020-01-01');
        $dateTo = $_GET['dateTo'] ?? date('Y-m-d', time());

        if ($dateFrom > $dateTo)
        {
            $dateFrom = date('Y-m-d', '2020-01-01');
            $dateTo = date('Y-m-d', time());
        }
        
        $db = new DBConnection();
        $db = $db->conn();

        $sqlString = "SELECT `order_items`.`product_id` AS 'product_id', COUNT(`order_items`.`product_id`) AS 'times_ordered' 
        FROM `order_items`
        INNER JOIN `order` ON `order`.`order_id` = `order_items`.`order_id` 
        WHERE `order`.`ordered_at` BETWEEN '$dateFrom' AND '$dateTo'
        GROUP BY `order_items`.`product_id`
        ORDER BY times_ordered ASC
        LIMIT 10";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        echo json_encode($resultArray);
    }

    // SALES OVER TIME
    public function ordersOverTime()
    {
        $roles = ["Admin"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $yr = $_GET['yr'] ?? date('Y', time());

        $pattern = "/^\d{4}$/i"; // matches a year, eg. 2020, 2019...
        if(!preg_match($pattern, $yr))
        {
            $yr = date('Y', time());
        }
        
        $db = new DBConnection();
        $db = $db->conn();

        $sqlString = "SELECT MONTHNAME(`ordered_at`) AS 'months', COUNT(`order_id`) AS 'orders'
        FROM `order` 
        WHERE YEAR(NOW()) LIKE '$yr'
        GROUP BY (SELECT EXTRACT(MONTH FROM `order`.`ordered_at`))
        ORDER BY `ordered_at` ASC
        LIMIT 12";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        echo json_encode($resultArray);
    }

    //ACTIVE USERS
    public function activeUsers()
    {
        $roles = ["Admin"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);
        
        $db = new DBConnection();
        $db = $db->conn();

        $sqlString = "SELECT CASE
        WHEN `is_active` = 0 THEN 'Inactive' ELSE 'Active' END AS `is_active`, COUNT(`user_id`) AS 'users' FROM `user` GROUP BY `is_active`";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        echo json_encode($resultArray);
    }

    /**
     * Read one object from table products - get method
     */
    public function details()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("product_id = $model->product_id"));

        echo $this->view("productDetails", "main", $model);
    }

    /**
     * Edit one object from table products - get method
     */
    public function edit()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $model = new ProductModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("product_id = $model->product_id"));

        echo $this->view("productEdit", "main", $model);
    }

    /**
     * Create one object from table products - get method
     */
    public function create()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $model = new ProductModel();

        echo $this->view("productCreate", "main", $model);
    }

    /**
     * Delete one object from table products - get method
     */
    public function delete()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $model = new ProductModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("product_id = $model->product_id"));

        if ($model->delete("product_id = $model->product_id")){
            Application::$app->session->setFlash('product_deleted', "Product deleted!");
            Application::$app->response->redirect("/profile");
            return;
        }

        Application::$app->session->setFlash('product_delete_error', "Product could not be deleted!");
        Application::$app->response->redirect("/profile");
    }

    /**
     * Create one object into table product - post method
     */
    public function createProcess()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $model = new ProductModel();

        $model->loadData($this->request->all());

        $model->validate();

        if (!empty($_FILES['image_path']['name'])) {
            // File was selected for upload
        
            $target_dir = "assets/img/product-img/";
            $target_file = $target_dir . basename($_FILES["image_path"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            $check = getimagesize($_FILES["image_path"]["tmp_name"]);
            if($check !== false) {
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                    if ($_FILES["image_path"]["size"] < 5000000) { //file size of up to ~500KB is allowed
                        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) { // trying to upload
                            $model->image_path = $target_file;
                        }
                    }
                }
            }
        } else $model->image_path = 'https://i.imgur.com/PoOoegs.png';

        if ($model->errors === null)
        {
            $user = $_SESSION['user']->{'user_id'};
            $modelConn = new DBConnection();
            $db = $modelConn->conn();

            if($this->createFullProduct($user, $model, $db))
            {
                Application::$app->session->setFlash('success', "Successfully added new product!");
                Application::$app->response->redirect("/productCreate");
                return;
            }
        }
        Application::$app->session->setFlash('errors', "Could not create new product");
        Application::$app->response->redirect("/productCreate");
    }

    /**
     * Edit one object from table product - post method
     */
    public function editProcess()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $model = new ProductModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null)
        {
            if ($model->updateProduct($model)){
                Application::$app->session->setFlash('success', "Successfully updated!");
                Application::$app->response->redirect("/productEdit?product_id=$model->product_id");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/productEdit?product_id=$model->product_id");
    }

    /**
     * Delete one object from table product
     */
    public function deleteProcess()
    {
        $roles = ["Admin", "User"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);
        
        $model = new ProductModel();

        $model->loadData($this->request->all());

        if ($model->delete("product_id = $model->product_id")){
            Application::$app->session->setFlash('success', "Product deleted!");
            Application::$app->response->redirect("/products");
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/products");
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function createUserProductItem($productId, $userId, $db)
    {
        $sqlString = "INSERT INTO `user_product` (`user_id`, `product_id`) VALUES ('$userId', '$productId');";

        $db->query($sqlString) or die();

        return true;
    }

    public function createProduct($userId, $model, $db)
    {
        $sqlString = "INSERT INTO `product` (`name`, `price`, `description`, `image_path`) VALUES ('$model->name', '$model->price', '$model->description', '$model->image_path')";

        $db->query($sqlString) or die();

        return true;
    }

    public function lastAddedProduct($db){
        $sqlString = "SELECT `product_id` FROM `product` ORDER BY `product_id` DESC LIMIT 1";

        $dbData = $db->query($sqlString) or die();

        $lastAddedProduct = $dbData->fetch_assoc();

        return intval($lastAddedProduct['product_id']);
    }

    public function createFullProduct($userId, $model, $db)
    {
        $this->createProduct($userId, $model, $db);

        $productId = $this->lastAddedProduct($db);

        $result = $this->createUserProductItem($productId, $userId, $db);

        return $result;
    }
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    /**
     * Import data from json
     */
    public function importJsonProcess()
    {
        $roles = ["Admin"];
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);

        $model = new ProductModel();

        if ($_FILES['importJson']['name'] !== "" and $_FILES['importJson'] !== null) {
            $data = file_get_contents($_FILES['importJson']['tmp_name']);
            $dataDecoded = json_decode($data);

            $errors = $model->createList($dataDecoded);
 
            if (empty($errors)) {
                Application::$app->session->setFlash('success', "Massive import successful!");
            } else {
                Application::$app->session->setFlash('jsonErrors', "Could not import data...");
            }

            Application::$app->response->redirect("/profile");
        } else {
            Application::$app->response->redirect("/profile");
        }
    }


    public function athorize()
    {
        return [
            "Admin",
            "User",
            "Guest"
        ];
    }
}