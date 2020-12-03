<?php


namespace app\models;


use app\core\DBModel;
use app\core\Application;

class OrderModel extends DBModel
{
    public $user_id;
    public $order_id;
    public $ordered_at;

    public function tableName()
    {
        return "order";
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'order_id',
            'ordered_at'
        ];
    }

    public function rules(): array
    {
        return [
            
        ];
    }

    public function labels(): array
    {
        return[
            'user_id' => "ID",
            'order_id' => "Order ID",
            'ordered_at' => "Order placed on"
        ];
    }

    public function userOrdersList($user_id)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT `order`.order_id, `order`.ordered_at  FROM `order` JOIN `user` on `order`.user_id = `user`.user_id WHERE `order`.user_id = $user_id";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    

}