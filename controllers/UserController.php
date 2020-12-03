<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Application;
use app\models\UserModel;
use app\models\OrderModel;

class UserController extends Controller
{
    public function profile()
    {
        $model = new UserModel();
        $user = Application::$app->session->getAuth('user');

        $result['myProducts'] = $model->readMyProducts($user->{'email'});

        $result['userData'] = $model->readAllUserData($user->{'email'});

        $model = new OrderModel();
        $model->user_id = $user->{'user_id'};
        $result['orders'] = $model->userOrdersList($model->user_id);

        echo $this->view("profile", "main", $result);
    }

    public function profileUpdate()
    {
        $model = new UserModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null)
        {
            if ($model->updateUser($model)){
                $userModel = new UserModel();

                $userData = $userModel->readAllUserData($model->email);

                $userModel->loadData($userData);

                Application::$app->session->setAuth('user', $userModel);

                Application::$app->session->setFlash('success', "Successfully changed!");
                Application::$app->response->redirect("/profile");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/profile");
    }

    public function athorize()
    {
        return [
            "User",
            "Admin"
        ];
    }
}