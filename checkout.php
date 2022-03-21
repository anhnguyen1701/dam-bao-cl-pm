<?php
include("config.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Playfair Display" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/func.js"></script>
    <script>
        $(document).ready(function() {
            getTotal();
            $('#btn-checkout').click(function() {
                var name = $('#inputName').val();
                var phone = $('#inputPhone').val();
                var address = $('#inputAddress').val();
                var note = $('#inputNote').val();
                var city = $('#inputCity').val();

                var loader = $('#loader');
                var body = $('body')
                loader.css('visibility', 'visible');
                body.css('opacity', '0.3');
                loader.css('opacity', '1');

                setTimeout(
                    function() {
                        $.ajax({
                            url: "set_order.php",
                            type: "POST",
                            data: {
                                name: name,
                                phone: phone,
                                city: city,
                                address: address,
                                note: note,
                            },
                            cache: false,
                            success: function(dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    alert("Đặt hàng thành công");
                                } else if (dataResult.statusCode == 201) {
                                    alert(dataResult.error);
                                    alert("Error occured !");
                                }
                                loader.css('visibility', 'hidden');
                                body.css('opacity', '1');
                            }
                        })
                    }, 1500);

            })
        });
    </script>
</head>

<body class="container-fluid">
    <div id="loader" style="visibility: hidden;"></div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <?php include 'includes/sidebar.php'; ?>

    <?php include 'includes/header.php'; ?>





    <main class="main-checkout">
        <div class="row">
            <div class="col-lg-5">
                <h2>THANH TOÁN</h2>
            </div>
            <div class="col-lg-5">
            </div>
        </div>

        <form method="POST" action="register.php" class="container-fluid mt-4" style="padding: 0!important;">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-5">
                    <label for="inputName" class="form-label">HỌ VÀ TÊN</label>
                    <input type="text" name="lastName" class="form-control" id="inputName">
                </div>
                <div class="col-lg-5 col-md-5">
                    <label for="inputPhone" class="form-label">SỐ ĐIỆN THOẠI</label>
                    <input type="tel" name="phone" class="form-control" id="inputPhone">
                </div>
                <div class="col-lg-5 col-md-5">
                    <label for="inputCity" class="form-label">TỈNH/ THÀNH PHỐ</label><br>
                    <select class="form-select" id="inputCity" name="city">
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                        <option value="fiat">Hehe</option>
                        <option value="audi">Haha</option>
                    </select>
                </div>
                <div class="col-lg-5 col-md-5">
                    <label for="inputAddress" class="form-label">ĐỊA CHỈ</label>
                    <input type="text" name="address" class="form-control" id="inputAddress">
                </div>
                <div class="col-lg-10 col-md-10">
                    <label for="inputNote" class="form-label">GHI CHÚ</label>
                    <textarea rows="5" name="note" class="form-control" id="inputNote"></textarea>
                </div>
            </div>
        </form>
    </main>
    <nav class="checkout-container container-fluid py-3">
        <p id="p-total">TỔNG 0 VND</p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Launch demo modal
        </button>
        <button id="btn-checkout" type="button" class="btn btn-dark" style="padding-left: 80px!important; padding-right: 80px!important; margin-left: 30px!important;">THANH TOÁN</button>
    </nav>
</body>

</html>