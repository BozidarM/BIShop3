<?php


namespace app\core;


class Session
{
    protected const FLASH_KEY = 'flash_messages';
    protected const USER_KEY = 'user';

    public function __construct()
    {
        session_start();

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage)
        {
            $flashMessage['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key]= [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function setAuth($key, $user)
    {
        $_SESSION[$key] = $user;
    }

    public function getAuth($key)
    {
        return $_SESSION[$key] ?? false;
    }

    
    public function set($key, $user)
    {
        $_SESSION[$key] = $user;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    // ----------------------------- CART START ------------------------------

    public function addToCart() 
    {
        $product_id = $_POST['product_id'];
        $image_path = $_POST['image_path'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        if (!isset($_SESSION['cart'][$product_id])) 
        {
            $_SESSION['cart'][$product_id]['id'] = $product_id;
            $_SESSION['cart'][$product_id]['image_path'] = $image_path;
            $_SESSION['cart'][$product_id]['name'] = $name;
            $_SESSION['cart'][$product_id]['price'] = $price;
            return true;
        }

        return false;
    }

    public function removeFromCart($product_id) 
    {
        unset($_SESSION['cart'][$product_id]);
    }

    public function allInCart() 
    {
        return $_SESSION['cart'];
    }

    public function destroyCart()
    {
        unset($_SESSION['cart']);
    }

    // ----------------------------- CART END ------------------------------

    public function __destruct()
    {
       $flashMessages =  $_SESSION[self::FLASH_KEY] ?? [];

       foreach ($flashMessages as $key => &$flashMessage)
       {
           if ($flashMessage['remove']){
               unset($flashMessages[$key]);
           }
       }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}