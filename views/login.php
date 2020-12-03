<?php
use app\core\Application;

/** @var $params \app\models\LoginModel
 */

$errors = Application::$app->session->getFlash('errors');

if ($errors !== false)
{
    $params->errors = $errors;
}

// echo "<pre>";
// var_dump($params);
// echo "</pre>";

?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Login</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login LoginRowFixed">
    <div class="container-fluid">
        <div class="row centerForm">
            <div class="col-lg-3">
                <?php echo \app\core\Form::beginForm('loginProcess', 'post', 'login-form') ?>
                <?php echo "<h3>Please log in:</h3></br>" ?>
                    <div class="row flexDirectionColumn">
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'email', 'email')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'password', 'password')?>
                        </div>
                        <div class="col-md-12">
                            <button class="btn" type='submit'>Log in</button>
                        </div>
                        <br>
                        <div class="col-md-12 mt-2">
                            <p>Or you can <a href="/register" class="text-center">register now</a></p>
                        </div>
                    </div>
                <?php echo \app\core\Form::endForm() ?>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->







<?php

$error = Application::$app->session->getFlash('errorUser');

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