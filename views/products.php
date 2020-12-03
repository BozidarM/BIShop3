<?php
use app\core\Application;
?>

<!-- <?php

// echo "<pre>";
// var_dump($params);
// echo "</pre>";

?> -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="productDiv">
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="searchSmall">Search by name:</label>
                                    <!-- Search form -->
                                    <input class="form-control" id="search" name="searchSmall" type="text" placeholder="Search...">
                                </div>
                                <div class="col-md-4">
                                    <label for="sortByDate">Sort by date:</label>
                                    <select class="custom-select mr-sm-2" id="sortByDate">
                                        <option value="" selected>None</option>
                                        <option value="desc">Latest first</option>
                                        <option value="asc">Oldest first</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="sortByPrice">Sort by price:</label>
                                    <select class="custom-select mr-sm-2" id="sortByPrice">
                                        <option value="" selected>None</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- items here -->
                    
                    

                </div>
                
                <!-- Pagination Start -->
                <div class="col-md-12">
                    <button type=button id="loadMoreBtn" class="btn btn-primary w-100">Load more
                    &nbsp;
                    <span class="spinner-border spinner-border-sm" id="progress" role="status" aria-hidden="true" style="display: none !important;"></span>
                    </button>
                </div>
                <!-- Pagination Start -->
            </div>           
            
        </div>
    </div>
</div>
        <!-- Product List End --> 


<!-- WBISFrameworkScripts -->
<script src="assets/js/WBISFrameworkScripts.js"></script>

<script>
    $(document).ready(function (){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        <?php
            $success = Application::$app->session->getFlash('success');
            if ($success !== false)
            {
                echo "
                    Toast.fire({
                        icon: 'success',
                        title: '$success'
                    });
                ";
            }
        ?>

        var url = "/productsJSON";


        var sortByDate = $("#sortByDate").val();
        var sortByPrice = $("#sortByPrice").val();
        var numberOfPage = 0;
        var numberOfRows = 12;
        var search = $("#search").val();
        var moreData = true;

        loadMoreProductsData( $("#productDiv"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search, sortByDate, sortByPrice);
        numberOfPage++;

        $("#sortByDate").change(function(){
            sortByDate = $("#sortByDate").val();
            numberOfPage = 0;
            $(".oneItem").remove();

            loadMoreProductsData( $("#productDiv"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search, sortByDate, sortByPrice);
            numberOfPage++;
            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);
        });
        
        $("#sortByPrice").change(function(){
            sortByPrice = $("#sortByPrice").val();
            numberOfPage = 0;
            $(".oneItem").remove();

            loadMoreProductsData( $("#productDiv"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search, sortByDate, sortByPrice);
            numberOfPage++;
            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);
        });
        

        $("#search").keyup(function (){
            search = $("#search").val();
            numberOfPage = 0;
            $(".oneItem").remove();

            loadMoreProductsData( $("#productDiv"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search, sortByDate, sortByPrice);
            numberOfPage++;
            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);
        });

        $("#loadMoreBtn").click(function (){
            loadMoreProductsData( $("#productDiv"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search, sortByDate, sortByPrice);
            numberOfPage++;
        });
    });
</script>