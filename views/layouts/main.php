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
// var_dump($_SESSION['cart']);
// echo "</pre>";

// session_destroy();

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

        <!-- CHART JS css -->
        <style type="text/css">
            /* Chart.js */
            @keyframes chartjs-render-animation {
                from {
                    opacity: .99
                }

                to {
                    opacity: 1
                }
            }

            .chartjs-render-monitor {
                animation: chartjs-render-animation 1ms
            }

            .chartjs-size-monitor,
            .chartjs-size-monitor-expand,
            .chartjs-size-monitor-shrink {
                position: absolute;
                direction: ltr;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                overflow: hidden;
                pointer-events: none;
                visibility: hidden;
                z-index: -1
            }

            .chartjs-size-monitor-expand>div {
                position: absolute;
                width: 1000000px;
                height: 1000000px;
                left: 0;
                top: 0
            }

            .chartjs-size-monitor-shrink>div {
                position: absolute;
                width: 200%;
                height: 200%;
                left: 0;
                top: 0
            }
        </style>

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
                            <a href="/cart" class="nav-item nav-link">Cart</a>
                            <?php if(isset($_SESSION['user'])) echo '<a href="/profile" class="nav-item nav-link">My profile</a>' ?>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <?php if(!isset($_SESSION['user'])) echo 
                            '<div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                                <div class="dropdown-menu">
                                    <a href="/login" class="dropdown-item">Login</a>
                                    <a href="/register" class="dropdown-item">Register</a>
                                </div>
                            </div>'; else
                            echo '<a href="/logout" class="nav-item nav-link">Logout</a>';
                            ?>
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
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="/home">
                                <img src="assets/img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="/cart" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="shoppingCart"><?php if (isset($_SESSION['cart'])) echo "(" . count($_SESSION['cart']) . ")"; else echo "(" . 0 . ")" ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->   

        

        <!-- JQUERY -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- ChartJS -->
        <script src="assets/js/chart.js/Chart.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="assets/js/sweetalert2.min.js"></script>

        {{ renderSection }}     
        
        <!-- Footer Start -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Get in Touch</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>123 BIShop3, Belgrade, Serbia</p>
                                <p><i class="fa fa-envelope"></i>email@example.com</p>
                                <p><i class="fa fa-phone"></i>+381-63-456-7890</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Follow Us</h2>
                            <div class="contact-info">
                                <div class="social">
                                    <a href="/home"><i class="fab fa-twitter"></i></a>
                                    <a href="/home"><i class="fab fa-facebook-f"></i></a>
                                    <a href="/home"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="/home"><i class="fab fa-instagram"></i></a>
                                    <a href="/home"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Company Info</h2>
                            <ul>
                                <li><a href="/home">About Us</a></li>
                                <li><a href="/home">Privacy Policy</a></li>
                                <li><a href="/home">Terms & Condition</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Purchase Info</h2>
                            <ul>
                                <li><a href="/home">Pyament Policy</a></li>
                                <li><a href="/home">Shipping Policy</a></li>
                                <li><a href="/home">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>We Accept:</h2>
                            <img src="assets/img/payment-method.png" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Secured By:</h2>
                            <img src="assets/img/godaddy.svg" alt="Payment Security" />
                            <img src="assets/img/norton.svg" alt="Payment Security" />
                            <img src="assets/img/ssl.svg" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>



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

        <!-- JavaScript Libraries -->
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="assets/lib/easing/easing.min.js"></script>
        <script src="assets/lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="assets/js/main.js"></script>

        <!-- cartAjax.js -->
        <script src="assets/js/cartAjax.js"></script>
        
        <script>
            // $(document).ready(function(){
            //     const Toast = Swal.mixin({
            //         toast: true,
            //         position: 'top-end',
            //         showConfirmButton: false,
            //         timer: 3000
            //     });

            //     $(".cartItem").click(function() {
            //         var product_id = $(this).attr('itemId');
            //         var image = $(this).attr('itemImage');
            //         var name = $(this).attr('itemName');
            //         var price = $(this).attr('itemPrice');
                    
            //         data = {
            //             "product_id": product_id,
            //             "image_path": image,
            //             "name": name,
            //             "price": price
            //         };

            //         // alert(addToCartAjax(data));
                    
            //         if (addToCartAjax(data, false)){
            //             Toast.fire({
            //                 icon: 'success',
            //                 title: 'Added item to cart'
            //             });
            //         }else{
            //             Toast.fire({
            //                 icon: 'error',
            //                 title: 'Error!'
            //             });
            //         }
            //     });
            // });

            
            

            $(document).on("click", ".cartItem", function(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                var product_id = $(this).attr('itemId');
                    var image = $(this).attr('itemImage');
                    var name = $(this).attr('itemName');
                    var price = $(this).attr('itemPrice');
                    
                    data = {
                        "product_id": product_id,
                        "image_path": image,
                        "name": name,
                        "price": price
                    };

                    // alert(addToCartAjax(data));
                    
                    if (addToCartAjax(data, false)){
                        Toast.fire({
                            icon: 'success',
                            title: 'Added item to cart'
                        });
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: 'Item is already in your cart'
                        });
                    }
            });
        </script>
        
        
    </body>
</html>

