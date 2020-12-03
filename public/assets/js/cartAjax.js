function addToCartAjax(data, returnValue) {
    $.ajax({
        method: "POST",
        url: "/addToCart",
        data: data,
        async: false,
        dataType: "json",
        success: function(result)
        {
            if(result >= 0)
            {
                $("#shoppingCart").empty();
                $("#shoppingCart").html("(" + result + ")");
                returnValue = true;
            }
        }
    });

    return returnValue;
}