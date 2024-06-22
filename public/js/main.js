$(document).ready(function () {
    (token = $('meta[name="csrf-token"]').attr("content")),
        $(".addToCart").click(function (e) {
            e.preventDefault();
            console.log('from cart');
            var id = $(this).closest(".product-data").find(".product_id").val();
            var product_qty = $(this)
                .closest(".product-data")
                .find(".qty-input")
                .val();
            $.ajax({
                type: "POST",
                url: "/addToCart",
                data: {
                    _token: token,
                    product_id: id,
                    quantity: product_qty,
                },
                success: function (response) {
                    alert(response.status);
                    console.log(response);
                },
            });
        });

    $(".addToWishlist").click(function (e) {
        console.log('from wishlist');
        e.preventDefault();
        var data = {
            _token: token,
            product_id: $(this)
                //.closest(".product-data")
                .find(".product_id")
                .val(),
        };
        $.ajax({
            type: "POST",
            url: "/addToWishlist",
            data: data,
            success: function (response) {
                alert(response.status);
                console.log(response);
            },
        });
    });
});

function increaseQuantity(e, inputID,max=10) {
    e.preventDefault();
    var id = `#${inputID}`;
    var inc_value = $(id).val();
    var value = isNaN(parseInt(inc_value, 10)) ? 0 : inc_value;
    if (value < max) {
        value++;
        $(id).val(value);
    }
}
function decreaseQuantity(e, inputID,min=1) {
    e.preventDefault();
    var id = `#${inputID}`;
    var dec_value = $(id).val();
    var value = isNaN(parseInt(dec_value, 10)) ? 0 : dec_value;
    if (value > min) {
        value--;
        $(id).val(value);
    }
}
