<?php


namespace app\models;


use app\core\DBModel;

class UserRolesModel extends DBModel
{
    public $user_role_id;
    public $role_id;
    public $user_id;


    public function tableName()
    {
        return "user_role";
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'role_id'
        ];
    }

    public function rules(): array
    {
        return[];
    }

    public function labels(): array
    {
        return[];
    }
}