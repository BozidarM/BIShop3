<?php
    use app\core\Application;
?>

<?php

$success = Application::$app->session->getAuth('user');

?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active">Product Details</li>
            </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="product-detail">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-detail-top">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="product-slider-single normal-slider">
                                        <img src=<?php echo "$params->image_path" ?> alt="Product Image" style=" max-width: 300px; max-height: 300px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-content">
                                        <div class="title"><h2><?php echo "$params->name" ?></h2></div>
                                        <div class="price">
                                            <h4>Price:</h4>
                                            <p><?php echo "$params->price" . "€" ?></p>
                                        </div>
                                        <div class="action">
                                        <a class='btn cartItem' itemId='<?php echo $params->product_id ?>' itemImage='<?php echo $params->image_path ?>' itemName='<?php echo $params->name ?>' itemPrice='<?php echo $params->price ?>'><i class='fa fa-shopping-cart'></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row product-detail-bottom">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="description" class="container tab-pane active">
                                        <h4>Product description</h4>
                                        <p>
                                            <?php echo "$params->description" ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <!-- Product Detail End -->