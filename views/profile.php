<?php
    use app\core\Application;
    use app\models\UserModel;

/** @var $params \app\models\UserModel
     */

    $errors = Application::$app->session->getFlash('errors');

    // if ($errors !== false)
    // {
    //     $params->errors = $errors;
    // }

    // echo "<pre>";
    // var_dump($params);
    // echo "</pre>";
    
    $currentRole = Application::$app->session->getAuth('user')->role_name;
?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">My Profile</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- My Account Start -->
<div class="my-account LoginRowFixed">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                            <?php if ($currentRole == 'Admin')
                            echo '<a class="nav-link" id="dashboard-nav-admin" data-toggle="pill" href="#dashboard-tab-admin" role="tab"><i class="fa fa-tachometer-alt"></i>Dashboard</a>';
                            ?>
                            <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-user"></i>User details</a>
                            <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                            <a class="nav-link" id="my-product-nav" data-toggle="pill" href="#my-product-tab" role="tab"><i class="fas fa-box"></i>My products</a>
                            <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fas fa-edit"></i>Update profile</a>
                            <a class="nav-link" href="/logout"><i class="fa fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <!-- ------------------------------------------------ START DASHBOARD ADMIN GRAPHS-------------------------------------------------------- -->
                            <?php if ($currentRole == 'Admin') { ?>
                            <div class="tab-pane fade" id="dashboard-tab-admin" role="tabpanel" aria-labelledby="dashboard-nav-admin">
                                <h4>Admin Dashboard</h4>
                                <!-- CHART 1 (USERS WITH MOST ORDERS) -->
                                <h3 class="mt-5">Users with the most orders (in a given time period):</h3>
                                <div>
                                    <label for="dateFrom">Date from:</label>
                                    <input type="date" id="dateFrom" class="dateInput" name="dateFrom">
                                    <label for="dateTo">Date to:</label>
                                    <input type="date" id="dateTo" class="dateInput" name="dateTo">
                                </div>
                                <div class="chart" id="chartDivParent">
                                    <canvas id="mostBuys" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                                </div>
                                <!-- CHART 2 (BEST SELLING PRODUCTS) -->
                                <h3 class="mt-5">Best selling products (in a given time period):</h3>
                                <div>
                                    <label for="dateFrom2">Date from:</label>
                                    <input type="date" id="dateFrom2" class="dateInput2" name="dateFrom2">
                                    <label for="dateTo2">Date to:</label>
                                    <input type="date" id="dateTo2" class="dateInput2" name="dateTo2">
                                </div>
                                <div class="chart" id="chartDivParent2">
                                    <canvas id="mostSelling" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                                </div>
                                <!-- CHART 3 (WORST SELLING PRODUCTS) -->
                                <h3 class="mt-5">Worst selling products (in a given time period):</h3>
                                <div>
                                    <label for="dateFrom3">Date from:</label>
                                    <input type="date" id="dateFrom3" class="dateInput3" name="dateFrom3">
                                    <label for="dateTo3">Date to:</label>
                                    <input type="date" id="dateTo3" class="dateInput3" name="dateTo3">
                                </div>
                                <div class="chart" id="chartDivParent3">
                                    <canvas id="worstSelling" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                                </div>
                                <!-- CHART 4 (ORDERS OVER TIME) -->
                                <h3 class="mt-5">Orders over time (in a year):</h3>
                                <div>
                                    <label for="yr">Year:</label>
                                    <input type="text" id="yr" class="yr" name="yr">
                                </div>
                                <div class="chart" id="chartDivParent4">
                                    <canvas id="ordersOverTime" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                                </div>
                                <!-- CHART 5 (ACTIVE/INACTIVE USERS PIE) -->
                                <h3 class="mt-5">Active and inactive users:</h3>
                                <div class="chart" id="chartDivParent5">
                                    <canvas id="activeUsers" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- -------------------------------------------------------- END DASHBOARD ADMIN -------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                                <h4 class="text-uppercase font-weight-bold">User details</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <h5>Name</h5>
                                            <p><?php echo $params['userData']['first_name']?></p>
                                        </div> 
                                        <div>
                                            <h5>Last name</h5>
                                            <p><?php echo $params['userData']['last_name']?></p>
                                        </div>
                                        <div>
                                            <h5>E-mail</h5>
                                            <p><?php echo $params['userData']['email']?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <h5>Role</h5>
                                            <p><?php echo $params['userData']['role_name']?></p>
                                        </div>
                                        <div>
                                            <h5>Status</h5>
                                            <p><?php if ($params['userData']['is_active'] == 1) echo "Active account"; else echo "Inactive user"?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Order</th>
                                                <th>Order ID</th>
                                                <th>Placed on</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($params['orders'])) { ?>
                                                <?php for ( $i = 0; $i < count($params['orders']) ; ++$i) { ?>
                                                    <tr>
                                                        <td><?php echo ($i+1) ?></td>
                                                        <td><?php echo $params['orders'][$i]['order_id'] ?></td>
                                                        <td><?php echo $params['orders'][$i]['ordered_at'] ?></td>
                                                        <td>Realized</td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else echo "<td colspan='4'>No items here!</td>"?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="my-product-tab" role="tabpanel" aria-labelledby="my-product-nav">
                                
                                <a href="/productCreate" class="btn">Add new product</a>
                                
                                <?php if ($currentRole == 'Admin') { ?>
                                <form class='mt-3' action="importProductJsonProcess" method="post" enctype="multipart/form-data">
                                    <button type="submit" class="btn">Submit JSON</button>
                                    <input type="file" name="importJson" id="importJson" accept="application/json">
                                </form>
                                <?php } ?>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Product</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Date created</th>
                                                <th>Date updated</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($params['myProducts']) && !empty($params['myProducts'])) { ?>
                                                <?php for ( $i = 0; $i < count($params['myProducts']) ; ++$i) { ?>
                                                    <tr>
                                                        <td><?php echo ($i+1) ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['product_id'] ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['name'] ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['price'] ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['description'] ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['image_path'] ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['created_at'] ?></td>
                                                        <td><?php echo $params['myProducts'][$i]['updated_at'] ?></td>
                                                        <td>
                                                            <?php echo sprintf("<a href='/productEdit?product_id=%s'", $params['myProducts'][$i]['product_id']) . "class='btn'>Edit</a>"; ?>
                                                            <?php echo sprintf("<a href='/productDelete?product_id=%s'", $params['myProducts'][$i]['product_id']) . "class='btn'>Delete</a>"; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else echo "<td colspan='9'>No items here!</td>"?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                                <h4>You can update your account information here:</h4>
                                <div class="row">
                                    <?php echo \app\core\Form::beginForm('updateUserData', 'post', 'login-form') ?>
                                        <?php $paramsNew = new UserModel(); ?>
                                        <?php
                                            echo "<input type='hidden' name='user_id' value='" . $params['userData']['user_id'] . "'>";
                                        ?>
                                        <div class="row flexDirectionColumn">
                                            <div class="col-md-12">
                                                <?php echo \app\core\Form::field($paramsNew, 'first_name', 'text')?>
                                            </div>
                                            <div class="col-md-12">
                                                <?php echo \app\core\Form::field($paramsNew, 'last_name', 'text')?>
                                            </div>
                                            <div class="col-md-12">
                                                <?php echo \app\core\Form::field($paramsNew, 'email', 'email')?>
                                            </div>
                                            <div class="col-md-12">
                                                <?php echo \app\core\Form::field($paramsNew, 'password', 'password')?>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn" type="submit">Update profile</button>
                                            </div>
                                        </div>
                                    <?php echo \app\core\Form::endForm() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account End -->

<?php

$product_deleted = Application::$app->session->getFlash('product_deleted');
$product_delete_error = Application::$app->session->getFlash('product_delete_error');

if ($product_delete_error  !== false) {
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
                    title: '$product_delete_error'
                })
            });
        </script>
        ";
} 
elseif ($product_deleted !== false)
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
                title: '$product_deleted'
            })
        });
    </script>
    ";
}
// -------------------------------------- massive import SWEETALERT2 -----------------------------------------

$jsonInfo = Application::$app->session->getFlash('jsonErrors');
$suc = Application::$app->session->getFlash('success');

if ($jsonInfo  !== false) {
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
                    title: '$jsonInfo'
                })
            });
        </script>
        ";
} elseif ($suc  !== false)
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
                        title: '$suc'
                    })
                });
            </script>
            ";
    
}



?>



<?php if ($currentRole == 'Admin') { ?>
<!-- CHART JS -------------------------------------------------------------------------------------------------------------------------------------- -->

<script>
    $(document).ready(function(){

        //format date YYYY-MM-DD
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }

        var dateFrom = '2020-01-01';
        var dateTo = formatDate(Date.now());

        // CHART 1 --------- USERS WITH THE MOST ORDERS IN A GIVEN TIME PERIOD -----------------------------------------------------------------------------------------------
        $(".dateInput").change(function(){
            var dateFrom = $("#dateFrom").val();
            var dateTo = $("#dateTo").val();

            if (dateTo == '')
            {
                dateTo = formatDate(Date.now());
            }

            if (dateFrom > dateTo)
            {
                alert("Check your input dates, please.");
            }
            else
            {
                $("#mostBuys").remove();
                $("#chartDivParent").append(
                    '<canvas id="mostBuys" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>'
                );

                url = '/mostBuys?dateFrom=' + dateFrom + '&dateTo=' + dateTo + "";

                $.getJSON(url, function (result){
                    var labelsActive = result.map(function (e){
                        return e.user_id;
                    });

                    var numberOfCustomersActive = result.map(function (e){
                        return e.number_of_orders;
                    });

                    var setData = {
                        labels: labelsActive,
                        datasets: [
                            {
                                label: "Users with the most orders",
                                data: numberOfCustomersActive,
                                backgroundColor: ["#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6" ],
                                hoverBackgroundColor: ["#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb"]
                            }]
                    }

                    var graphActive = $("#mostBuys").get(0).getContext('2d');

                    createBarGraph(setData, labelsActive, graphActive);
                });



            }
        });


        // CHART 2 --------- BEST SELLING PRODUCTS ---------------------------------------------------------------------------------------------------------------------
        $(".dateInput2").change(function(){
            var dateFrom = $("#dateFrom2").val();
            var dateTo = $("#dateTo2").val();

            if (dateTo == '')
            {
                dateTo = formatDate(Date.now());
            }

            if (dateFrom > dateTo)
            {
                alert("Check your input dates, please.");
            }
            else
            {
                $("#mostSelling").remove();
                $("#chartDivParent2").append(
                    '<canvas id="mostSelling" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>'
                );

                url2 = '/mostSelling?dateFrom=' + dateFrom + '&dateTo=' + dateTo + "";

                console.log(url2);

                $.getJSON(url2, function (result){
                    var labelsActive = result.map(function (e){
                        return e.product_id;
                    });

                    var numberOfCustomersActive = result.map(function (e){
                        return e.times_ordered;
                    });

                    var setData = {
                        labels: labelsActive,
                        datasets: [
                            {
                                label: "Best selling products",
                                data: numberOfCustomersActive,
                                backgroundColor: ["#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6" ],
                                hoverBackgroundColor: ["#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb"]
                            }]
                    }

                    var graphActive = $("#mostSelling").get(0).getContext('2d');

                    createBarGraph(setData, labelsActive, graphActive);
                });



            }
        });

        // CHART 3 --------- WORST SELLING PRODUCTS ---------------------------------------------------------------------------------------------------------------------
        $(".dateInput3").change(function(){
            var dateFrom = $("#dateFrom3").val();
            var dateTo = $("#dateTo3").val();

            console.log(dateFrom);
            console.log(dateTo);

            if (dateTo == '')
            {
                dateTo = formatDate(Date.now());
            }

            if (dateFrom > dateTo)
            {
                alert("Check your input dates, please.");
            }
            else
            {
                $("#worstSelling").remove();
                $("#chartDivParent3").append(
                    '<canvas id="worstSelling" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>'
                );

                url3 = '/worstSelling?dateFrom=' + dateFrom + '&dateTo=' + dateTo + "";

                console.log(url3);

                $.getJSON(url3, function (result){
                    var labelsActive = result.map(function (e){
                        return e.product_id;
                    });

                    var numberOfCustomersActive = result.map(function (e){
                        return e.times_ordered;
                    });

                    var setData = {
                        labels: labelsActive,
                        datasets: [
                            {
                                label: "The worst selling products",
                                data: numberOfCustomersActive,
                                backgroundColor: ["#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6" ],
                                hoverBackgroundColor: ["#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb"]
                            }]
                    }

                    var graphActive = $("#worstSelling").get(0).getContext('2d');

                    createBarGraph(setData, labelsActive, graphActive);
                });



            }
        });

        // CHART 4 --------- ORDERS OVER TIME ---------------------------------------------------------------------------------------------------------------------
        $("#yr").change(function(){
            var yr = $("#yr").val();

            console.log(yr);

            $("#ordersOverTime").remove();
            $("#chartDivParent4").append(
                '<canvas id="ordersOverTime" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250"class="chartjs-render-monitor"></canvas>'
            );
            url4 = '/ordersOverTime?yr=' + yr + "";

            $.getJSON(url4, function (result){
                var labels = result.map(function (e){ // x vrednosti
                return e.months;  // e.poljeIzBaze
                });

                var numberOfCustomers = result.map(function (e){ // y vrednosti
                    return e.orders;
                });

                var graph = $("#ordersOverTime").get(0).getContext('2d');

                createGraph(numberOfCustomers, labels, graph);
            });

        });

        // --------------------------------------------------------------------------- ON LOAD ---------------------------------------------------------------------------
        var url = '/mostBuys?dateFrom=' + dateFrom + '&dateTo=' + dateTo + "";
        var url2 = '/mostSelling?dateFrom=' + dateFrom + '&dateTo=' + dateTo + "";
        var url3 = '/worstSelling?dateFrom=' + dateFrom + '&dateTo=' + dateTo + "";
        var url4 = '/ordersOverTime?yr=' + yr + "";
        var url5 = '/activeUsers';

        // CHART 1 ON LOAD
        $.getJSON(url, function (result){
            var labelsActive = result.map(function (e){
                return e.user_id;
            });

            var numberOfCustomersActive = result.map(function (e){
                return e.number_of_orders;
            });

            var setData = {
                labels: labelsActive,
                datasets: [
                    {
                        label: "Users with the most orders",
                        data: numberOfCustomersActive,
                        backgroundColor: ["#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6" ],
                        hoverBackgroundColor: ["#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb"]
                    }]
            }

            var graphActive = $("#mostBuys").get(0).getContext('2d');

            createBarGraph(setData, labelsActive, graphActive);
        });

        // CHART 2 best selling products
        $.getJSON(url2, function (result){
            var labelsActive = result.map(function (e){
                return e.product_id;
            });

            var numberOfCustomersActive = result.map(function (e){
                return e.times_ordered;
            });

            var setData = {
                labels: labelsActive,
                datasets: [
                    {
                        label: "The best selling products",
                        data: numberOfCustomersActive,
                        backgroundColor: ["#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6" ],
                        hoverBackgroundColor: ["#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb"]
                    }]
            }

            var graphActive = $("#mostSelling").get(0).getContext('2d');

            createBarGraph(setData, labelsActive, graphActive);
        });

        // CHART 3  worst selling ON LOAD
        $.getJSON(url3, function (result){
            var labelsActive = result.map(function (e){
                return e.product_id;
            });

            var numberOfCustomersActive = result.map(function (e){
                return e.times_ordered;
            });

            var setData = {
                labels: labelsActive,
                datasets: [
                    {
                        label: "The worst selling products",
                        data: numberOfCustomersActive,
                        backgroundColor: ["#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6", "#0c78a6" ],
                        hoverBackgroundColor: ["#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb", "#09c5eb"]
                    }]
            }

            var graphActive = $("#worstSelling").get(0).getContext('2d');

            createBarGraph(setData, labelsActive, graphActive);
        });

        // CHART 4 orders over time ON LOAD
        $.getJSON(url4, function (result){
            var labels = result.map(function (e){ // x vrednosti
               return e.months;  // e.poljeIzBaze
            });

            var numberOfCustomers = result.map(function (e){ // y vrednosti
                return e.orders;
            });

            var graph = $("#ordersOverTime").get(0).getContext('2d');

            createGraph(numberOfCustomers, labels, graph);
        });

        // CHART 5 active users
        $.getJSON(url5, function (result){
            var labelsActive = result.map(function (e){
                return e.is_active;
            });

            var numberOfCustomersActive = result.map(function (e){
                return e.users;
            });

            var setData = {
                labels: labelsActive,
                datasets: [
                    {
                        label: "Active users",
                        data: numberOfCustomersActive,
                        backgroundColor: ["#ad241a", "#0c78a6"],
                        hoverBackgroundColor: ["#e63d30", "#09c5eb"]
                    }]
            }

            var graphActivePie = $("#activeUsers").get(0).getContext('2d');

            createPieGraph(setData, labelsActive, graphActivePie);
        });


        // CREATE GRAPH FUNCTIONS --------------------------------------------------------------

        function createBarGraph(setData, labelsActive, graphActive){
            new Chart(graphActive, {
                // type: 'horizontalBar',
                type: 'bar',
                data: setData,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        function createPieGraph(setData, labelsActive, graphActive){
            new Chart(graphActive, {
                type: 'pie',
                data: setData
            });
        }

        function createGraph(numberOfCustomers, labels, graph){
            new Chart(graph, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        data: numberOfCustomers,
                        label: "Orders over time",
                        backgroundColor: 'rgb(173, 5, 5)',
                        borderColor: 'rgb(173, 5, 5)',
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Orders over time"
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                max: 250,
                                min: 0,
                            }
                        }]
                    },
                    legend: {
                        display: true
                    }
                }
        });
    }


<?php } ?>



























    });




</script>