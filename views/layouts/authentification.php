<?php
use app\core\Application;

/** @var $params \app\models\UserModel
 */

$errors = Application::$app->session->getFlash('errors');
$user = Application::$app->session->getAuth('user');

if ($user !== false) {
    $params = $user;
}

if ($errors !== false)
{
    @$params->errors = $errors;
}

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BIShop3</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="eCommerce HTML Template Free Download" name="keywords">
        <meta content="eCommerce HTML Template Free Download" name="description">

        <!-- Favicon -->
        <link rel="icon" href="assets/img/favicon.ico" >

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="assets/lib/slick/slick.css" rel="stylesheet">
        <link href="assets/lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="assets/css/style.css" rel="stylesheet">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="assets/css/bootstrap-4.min.css">


    </head>

    <body>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i>
                        support@email.com
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-phone-alt"></i>
                        +381-63-6789-10
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->
        
        <!-- Nav Bar Start -->
        <div class="nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="/home" class="nav-item nav-link">Home</a>
                            <a href="/products" class="nav-item nav-link">Products</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->      
        
        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="logo">
                            <a href="/home">
                                <img src="assets/img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->

        <!-- JavaScript Libraries -->
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="assets/lib/easing/easing.min.js"></script>
        <script src="assets/lib/slick/slick.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="assets/js/sweetalert2.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="assets/js/main.js"></script>


        {{ renderSection }}       


        <!-- Footer Start -->
        <div class="footer">
            <!-- Footer Bottom Start -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 copyright">
                            <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
                        </div>

                        <div class="col-md-6 template-by">
                            <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom End -->  


            <!-- Back to Top -->
            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>
        <!-- Footer End -->

    </body>
</html>

