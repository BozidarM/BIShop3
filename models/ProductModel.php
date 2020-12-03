<?php


namespace app\models;


use app\core\DBModel;
use app\core\Application;

class ProductModel extends DBModel
{
    public $product_id = '';
    public $name = '';
    public $price = '';
    public $description = '';
    public $image_path = '';
    public $created_at = '';
    public $updated_at = '';

    public function tableName()
    {
        return 'product';
    }

    public function attributes(): array
    {
        return [
            'product_id',
            'name',
            'price',
            'description',
            'image_path',
            'created_at',
            'updated_at'
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'name' => "Name",
            'price' => "Price",
            'description' => "Description",
            'image_path' => "Product Image"
        ];
    }

    public function updateProduct(ProductModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE `product` SET 
                    `name` = '$model->name',
                    `price` = '$model->price',
                    `description` = '$model->description',
                    `image_path` = '$model->image_path'
                    WHERE `product_id` = $model->product_id;";

        $db->query($sqlString) or die();

        return true;
    }

    public function productsLoadMore($numberOfPage, $numberOfRows, $search, $sortByDate, $sortByPrice)
    {
        $db = $this->dbConnection->conn();

        $order = "ORDER BY ";

        if (strtolower($sortByDate) == "asc" || strtolower($sortByDate) == "desc")
            $orderDate = "`created_at` " . "$sortByDate" . " ";
        else
            $orderDate = "";

        if (strtolower($sortByPrice) == "asc" || strtolower($sortByPrice) == "desc")
            $orderPrice = "`price` " . "$sortByPrice" . " ";
        else
            $orderPrice = "";

        if (($sortByDate !== "" && $sortByDate !== null) && ($sortByPrice !== "" && $sortByPrice !== null))
            $comma = ", ";
        else 
            $comma = "";

        if(($sortByDate === "" || $sortByDate === null) && ($sortByPrice === "" || $sortByPrice === null))
            $order = "";

        $order = $order . $orderPrice . $comma . $orderDate;

        if ($search !== null and $search !== ""){
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "SELECT * FROM `product` WHERE `name` LIKE '%$search%' $order LIMIT $startOn, $numberOfRows";
        }else
        {
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "SELECT * FROM `product` WHERE `name` LIKE '%$search%' $order LIMIT $startOn, $numberOfRows";
        }

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function createList($array)
    {
        $test = [];
        $br = 0;
        $db = $this->dbConnection->conn();
        $sqlString = "INSERT INTO `product` ( `name`, `price`, `description`, `image_path`) VALUES ";

        foreach ($array as $item) {
            $model = new ProductModel();

            $model->loadData($item);
            $model->validate();

            if ($model->errors !== null) {
                foreach ($model->errors as $attribute => $value) {
                    $test[$br][$attribute] = $value;
                }
            }

            $sqlString = $sqlString . "('$model->name', '$model->price', '$model->description', '$model->image_path'),";

            $br++;
        }

        $sqlString = substr_replace($sqlString ,";",-1);
        $db->query($sqlString) or die();

        $sqlString2 = "SELECT `product`.`product_id` FROM `product` ORDER BY `created_at` DESC LIMIT $br ";
        $products = $db->query($sqlString2) or die();
        $resultArray = [];

        while ($result = $products->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        $user_id = Application::$app->session->getAuth('user')->user_id;

        $sqlString3 = "INSERT INTO `user_product` (`user_id`, `product_id`) VALUES ";

        for ( $i = 0; $i < count($resultArray) ; ++$i)
        {
            $sqlString3 = $sqlString3 . "('$user_id', '" . $resultArray[$i]['product_id'] . "'),";
        }

        $sqlString3 = substr_replace($sqlString3 ,";",-1);
        $db->query($sqlString3) or die();

        return $test; //errors
    }
}