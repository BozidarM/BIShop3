<?php


namespace app\core;


class Form
{
    public static function beginForm($action, $method, $class)
    {
        return sprintf("<form action='%s' method='%s' class='%s' enctype='multipart/form-data'>", $action, $method, $class);
    }

    public static function endForm()
    {
        return "</form>";
    }

    public static function field($model, $attribute, $type)
    {
        return new Field($model, $attribute, $type);
    }
}