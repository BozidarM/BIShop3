<?php


namespace app\core;


use mysqli;

class DBConnection
{
    public function conn(){
        $mysqli = new mysqli("localhost", "root", "", "eshop") or die(mysqli_error($mysqli));

        return $mysqli;
    }
}