<?php
    use app\core\Application;
?>

<?php

$success = Application::$app->session->getAuth('user');

?>

<!-- Main Slider Start -->
<div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="header-slider normal-slider">
                            <div class="header-slider-item">
                                <img src="assets/img/slider-1.jpg" alt="Slider Image" />
                                <div class="header-slider-caption">
                                    <p>Some text goes here that describes the image</p>
                                    <a class="btn" href="/products"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                </div>
                            </div>
                            <div class="header-slider-item">
                                <img src="assets/img/slider-2.jpg" alt="Slider Image" />
                                <div class="header-slider-caption">
                                    <p>Some text goes here that describes the image</p>
                                    <a class="btn" href="/products"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                </div>
                            </div>
                            <div class="header-slider-item">
                                <img src="assets/img/slider-3.jpg" alt="Slider Image" />
                                <div class="header-slider-caption">
                                    <p>Some text goes here that describes the image</p>
                                    <a class="btn" href="/products"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="header-img">
                            <div class="img-item">
                                <img src="assets/img/category-1.jpg" />
                                <a class="img-text" href="">
                                    <p>Some text goes here that describes the image</p>
                                </a>
                            </div>
                            <div class="img-item">
                                <img src="assets/img/category-2.jpg" />
                                <a class="img-text" href="">
                                    <p>Some text goes here that describes the image</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Slider End -->          
        
        <!-- Feature Start-->
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fab fa-cc-mastercard"></i>
                            <h2>Secure Payment</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Worldwide Delivery</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-sync-alt"></i>
                            <h2>90 Days Return</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>24/7 Support</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->      
        
        <!-- Category Start-->
        <div class="category">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="category-item ch-400">
                            <img src="assets/img/category-3.jpg" />
                            <a class="category-name" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-item ch-250">
                            <img src="assets/img/category-4.jpg" />
                            <a class="category-name" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                        <div class="category-item ch-150">
                            <img src="assets/img/category-5.jpg" />
                            <a class="category-name" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-item ch-150">
                            <img src="assets/img/category-6.jpg" />
                            <a class="category-name" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                        <div class="category-item ch-250">
                            <img src="assets/img/category-7.jpg" />
                            <a class="category-name" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-item ch-400">
                            <img src="assets/img/category-8.jpg" />
                            <a class="category-name" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End-->       
        
        <!-- Featured Product Start -->
        <div class="featured-product product">
            <div class="container-fluid">
                <div class="section-header">
                    <h1>Newest products:</h1>
                </div>
                <div class="row align-items-center product-slider product-slider-4">


                    <?php for ($i=0; $i < count($params['newestProducts']); $i++) { ?>
                    <div class="col-lg-3">
                        <div class='product-item'>
                            <div class='product-title'>
                                <a href='#'><?php echo $params['newestProducts'][$i]['name'] ?></a>
                            </div>
                            <div class='product-image'>
                                <?php echo sprintf("<a href='/productDetails?product_id=%s'></a>", $params['newestProducts'][$i]['product_id']) ?>
                                    <?php echo sprintf("<img class='productImgDimension' src='%s' alt='Product Image'>", $params['newestProducts'][$i]['image_path']) ?>
                                </a>
                                <div class='product-action'>
                                    <?php echo sprintf("<a href='/productDetails?product_id=%s'><i class='fa fa-search'></i></a>", $params['newestProducts'][$i]['product_id']) ?>
                                </div>
                            </div>
                            <div class='product-price'>
                                <h3><?php echo $params['newestProducts'][$i]['price'] ?><span>€</span></h3>
                                <a class='btn cartItem' itemId='<?php echo $params['newestProducts'][$i]['product_id'] ?>' itemImage='<?php echo $params['newestProducts'][$i]['image_path'] ?>' itemName='<?php echo $params['newestProducts'][$i]['name'] ?>' itemPrice='<?php echo $params['newestProducts'][$i]['price'] ?>'><i class='fa fa-shopping-cart'></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>


                   


                </div>
            </div>
        </div>
        <!-- Featured Product End -->    
        
        <!-- Random Product Start -->
        <div class="recent-product product">
            <div class="container-fluid">
                <div class="section-header">
                    <h1>Some of our products:</h1>
                </div>
                <div class="row align-items-center product-slider product-slider-4">

                    <?php for ($i=0; $i < count($params['randomProducts']); $i++) { ?>
                    <div class="col-lg-3">
                        <div class='product-item'>
                            <div class='product-title'>
                                <a href='#'><?php echo $params['randomProducts'][$i]['name'] ?></a>
                            </div>
                            <div class='product-image'>
                                <?php echo sprintf("<a href='/productDetails?product_id=%s'></a>", $params['randomProducts'][$i]['product_id']) ?>
                                    <?php echo sprintf("<img class='productImgDimension' src='%s' alt='Product Image'>", $params['randomProducts'][$i]['image_path']) ?>
                                </a>
                                <div class='product-action'>
                                    <?php echo sprintf("<a href='/productDetails?product_id=%s'><i class='fa fa-search'></i></a>", $params['randomProducts'][$i]['product_id']) ?>
                                </div>
                            </div>
                            <div class='product-price'>
                                <h3><?php echo $params['randomProducts'][$i]['price'] ?><span>€</span></h3>
                                <a class='btn cartItem' itemId='<?php echo $params['randomProducts'][$i]['product_id'] ?>' itemImage='<?php echo $params['randomProducts'][$i]['image_path'] ?>' itemName='<?php echo $params['randomProducts'][$i]['name'] ?>' itemPrice='<?php echo $params['randomProducts'][$i]['price'] ?>'><i class='fa fa-shopping-cart'></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <!-- Random Product End -->

<?php

$successful_order = Application::$app->session->getFlash('order_placed');

if ($successful_order  !== false) {
    echo "
        <script>
            $(document).ready(function (){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });


                Toast.fire({
                    icon: 'success',
                    title: '$successful_order'
                })
            });
        </script>
        ";
}

?>