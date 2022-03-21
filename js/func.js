function getTotal() {
    $.ajax({
        url: "get_total.php",
        type: "POST",
        cache: false,
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $total = 'TỔNG ' + dataResult.total + ' VND';
                $('#p-total').text($total);
            } else if (dataResult.statusCode == 201) {
                alert("Error occured !");
            }
        }
    })
}

function getCartQuantity() {
    $.ajax({
        url: "get_cart_quantity.php",
        type: "POST",
        cache: false,
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $sum = dataResult.sum;
                if (!$sum) {
                    $sum = 0;
                    // $card.attr('style', 'display: none');
                }
                $text = 'GIỎ (' + $sum + ')';
                $('#cart-link').text($text);
            } else if (dataResult.statusCode == 201) {
                alert("Error occured !");
            }
        }
    })
}