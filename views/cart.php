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
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/products">Products</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row LoginRowFixed">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        <!-- Product start -->
                                        <?php if(isset($_SESSION['cart'])) { ?>
                                            <?php foreach($_SESSION['cart'] as $item) { ?>
                                            <tr>
                                                <td><?php echo $item['id']?></td>
                                                <td>
                                                    <div class="img">
                                                        <a><img src='<?php echo $item['image_path']?>' alt="Image"></a>
                                                        <p><?php echo $item['name']?></p>
                                                    </div>
                                                </td>
                                                <td><?php echo $item['price'] . '€'?></td>
                                                <td><a href='/removeFromCart?product_id=<?php echo $item['id']?>'><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <?php } ?>
                                        <?php } else echo "<td colspan='6'>No items here!</td>"?>
                                        <!-- Product end -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                                <?php
                                                $sum = 0;
                                                if(isset($_SESSION['cart']))
                                                {
                                                    foreach($_SESSION['cart'] as $item)
                                                    {
                                                        $sum = $sum + floatval($item['price']);
                                                    }
                                                }
                                                echo "<h2>Grand Total<span>$sum" . '€' . "</span></h2>";
                                                ?>
                                        </div>
                                        </br>
                                        <div class="cart-btn">
                                            <a href="/products">Shop more</a>
                                            <a href='<?php if(isset($_SESSION['user'])) echo '/checkout'; else echo '/login'  ?>'>Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->

<?php

$error = Application::$app->session->getFlash('errors');

if ($error  !== false) {
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
                    icon: 'error',
                    title: '$error'
                })
            });
        </script>
        ";
}

?>