<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Router;
use app\models\ProductModel;

class HomeController extends Controller
{
    public function dashboard()
    {
        $model = new ProductModel();

        $result['newestProducts'] = $model->newestProducts();
        $result['randomProducts'] = $model->randomProducts();

        echo $this->view("home", "main", $result);
    }

    public function athorize()
    {
        return [
            "Guest",
            "User",
            "Admin"
        ];
    }
}