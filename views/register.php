<?php
use app\core\Application;

/** @var $params \app\models\RegisterModel
 */

$errors = Application::$app->session->getFlash('errors');

if ($errors !== false)
{
    $params->errors = $errors;
}
?>


<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Register</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login LoginRowFixed">
    <div class="container-fluid">
        <div class="row centerForm">
            <div class="col-lg-3">    
                <?php echo \app\core\Form::beginForm('registerProcess', 'post', 'login-form') ?>
                <?php echo "<h3>Please fill out the form:</h3></br>" ?>
                    <div class="row flexDirectionColumn">
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'first_name', 'text')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'last_name', 'text')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'email', 'email')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'password', 'password')?>
                        </div>
                        <div class="col-md-12">
                            <?php echo \app\core\Form::field($params, 'confirmPassword', 'password')?>
                        </div>
                        <div class="col-md-12">
                            <button class="btn" type="submit">Register</button>
                        </div>
                        <div class="col-md-12 mt-2">
                            <a href="/login" class="text-center">I already have an account</a>
                        </div>
                    </div>
                <?php echo \app\core\Form::endForm() ?>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->





<?php

$success = Application::$app->session->getFlash('success');

if ($success !== false)
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


