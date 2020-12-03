<?php


namespace app\models;


use app\core\DBModel;
use app\core\Model;

class RegisterModel extends DBModel
{
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $first_name = '';
    public string $last_name = '';
    public bool $is_active = false;

    public function rules(): array
    {
        return [
            'first_name' => [self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED, self::RULE_EMAIL_UNIQUE],
            'password' => [self::RULE_REQUIRED],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    /**
     * @return table name
     */
    public function tableName()
    {
        return 'user';
    }

    public function attributes(): array
    {
        return [
            'first_name',
            'last_name',
            'email',
            'password',
            'is_active'
        ];
    }

    public function register(RegisterModel $model)
    {
        $model->password = password_hash($model->password, PASSWORD_DEFAULT);
        $model->is_active = true;

        $model->create();
        $userModel = new UserModel();

        $user = $userModel->one("email = '$model->email';");
        $userModel->loadData($user);

        $rolesModel = new RolesModel();
        $rolesModel->role_name = "User";
        $role = $rolesModel->one("role_name = '$rolesModel->role_name'");
        $rolesModel->loadData($role);

        $userRolesModel = new UserRolesModel();

        $userRolesModel->role_id = $rolesModel->role_id;
        $userRolesModel->user_id = $userModel->user_id;

        $userRolesModel->create();

        return true;
    }

    public function labels(): array
    {
        return [
            'first_name' => "First Name",
            'last_name' => "Last Name",
            'email' => "Email",
            'password' => "Password",
            'confirmPassword' => "Confirm Password"
        ];
    }
}