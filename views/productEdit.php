<?php
use app\core\Application;

/** @var $params \app\models\ProductModel
 */

?>

<?php

$success = Application::$app->session->getAuth('user');

?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active"><a href="/profile">My Profile</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login LoginRowFixed">
    <div class="container-fluid">
        <div class="row centerForm">
            <div class="col-lg-3">
                <?php echo \app\core\Form::beginForm('productEditProcess', 'post', 'login-form') ?>
                <?php echo "<h3>Create new product:</h3></br>" ?>
                    <div class="row flexDirectionColumn">
                        <?php
                            echo "<input type='hidden' name='product_id' value='$params->product_id'>"
                        ?>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'name', 'text')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'price', 'text')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'description', 'text')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'image_path', 'text')?>
                        </div>
                        <div class="col-md-12">
                            <button class="btn" type='submit'>Edit Product</button>
                        </div>
                        <br>
                        <div class="col-md-12 mt-2">
                            <p>Go back to your <a href="/profile" class="text-center">profile</a></p>
                        </div>
                    </div>
                <?php echo \app\core\Form::endForm() ?>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->

<?php

$error = Application::$app->session->getFlash('errors');
$success = Application::$app->session->getFlash('success');

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
elseif ($success !== false)
{
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
                title: '$success'
            })
        });
    </script>
    ";
}

?>