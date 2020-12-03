<?php


namespace app\models;


use app\core\DBModel;

class RolesModel extends DBModel
{
    public $role_id;
    public $role_name;

    public function tableName()
    {
        return "role";
    }

    public function attributes(): array
    {
        return [
            'role_name'
        ];
    }

    public function rules(): array
    {
        return[];
    }

    public function labels(): array
    {
        return [
            'role_name' => "Role Name"
        ];
    }
}