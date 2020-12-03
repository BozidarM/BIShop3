<?php


namespace app\models;


use app\core\DBModel;

class UserModel extends DBModel
{
    public $user_id;
    public $email = '';
    public $first_name = '';
    public $last_name = '';
    public $role_name;
    public $password = '';
    public $is_active;

    public function tableName()
    {
        return "user";
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'first_name',
            'last_name',
            'email',
            'password',
            'is_active'
        ];
    }

    public function rules(): array
    {
        return [
            'first_name' => [self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED, self::RULE_EMAIL_UNIQUE],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return[
            'user_id' => "ID",
            'first_name' => "First Name",
            'last_name' => "Last Name",
            'email' => "Email",
            'password' => "Password"
        ];
    }

    public function readAllUserData($email)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT 	
                        u.user_id,
                        u.first_name,
                        u.last_name,
                        u.email,
                        u.is_active,
                        r.role_name
                FROM user u
                INNER JOIN user_role ur on u.user_id = ur.user_id
                INNER JOIN role r on r.role_id = ur.role_id
                WHERE email ='$email'";

        $dataResult = $db->query($sqlString) or die();

        $result = $dataResult->fetch_assoc();

        return $result;
    }

    public function readMyProducts($email)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT 	
                        p.`product_id`,
                        p.`name`,
                        p.`price`,
                        p.`description`,
                        p.`image_path`,
                        p.`created_at`,
                        p.`updated_at`
                FROM product p
                INNER JOIN `user_product` up ON up.product_id = p.product_id
                INNER JOIN `user` u ON u.user_id = up.user_id
                WHERE email ='$email'";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function updateUser(UserModel $model)
    {
        $db = $this->dbConnection->conn();

        $model->password = password_hash($model->password, PASSWORD_DEFAULT);

        $sqlString = "UPDATE `user` SET `first_name` = '$model->first_name', `last_name` = '$model->last_name', `password` = '$model->password', `email` = '$model->email' WHERE `user_id` = $model->user_id";

        $db->query($sqlString) or die();

        return true;
    }

}