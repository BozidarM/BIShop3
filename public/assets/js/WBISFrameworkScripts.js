function loadMoreProductsData(jQueryObjectLoadMore, jQueryObjectLoadMoreBtn, jQueryObjectProgress, url, numberOfPage, numberOfRows, search, sortByDate, sortByPrice){
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows, "search": search, "sortByDate": sortByDate, "sortByPrice": sortByPrice };

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 12){
                moreData = false;

                jQueryObjectLoadMoreBtn.html("No more items!");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0)
            {
                $.each(result, function (index, item){
                    jQueryObjectLoadMore.append(
                        "<div class='col-md-3 oneItem'>" +
                            "<div class='product-item'>" +
                                "<div class='product-title'>" +
                                    "<a>" + item.name + "</a>" +
                                "</div>" +
                                "<div class='product-image'>" + 
                                    "<a href='/productDetails?product_id=" + Number(item.product_id) + "'></a>" +
                                        "<img class='productImgDimension' src='" + item.image_path + "' alt='Product Image'>" +
                                    "</a>" +
                                    "<div class='product-action'>" +
                                        "<a href='/productDetails?product_id=" + Number(item.product_id) + "'><i class='fa fa-search'></i></a>" +
                                    "</div>" +
                                "</div>" +
                                "<div class='product-price'>" +
                                    "<h3>" + item.price + "<span>€</span></h3>" +
                                    "<a class='btn cartItem' itemId=" + item.product_id + " itemImage=" + item.image_path + " itemName=" + item.name + " itemPrice=" + item.price + "><i class='fa fa-shopping-cart'></i>Add to cart</a>" +
                                "</div>" +
                            "</div>" +
                        "</div>"
                    );
                });
            }
        },
        error: function (){
            alert("Error loading data.");
        },
        beforeSend: function (){
            jQueryObjectProgress.show();
        },
        complete: function (){
            jQueryObjectProgress.hide();
        }
    });
}
