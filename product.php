<?php
session_start();
include("config.php");
$product_id = $_GET['p'];
$query = "SELECT * FROM product WHERE id = $product_id LIMIT 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $price = $row['price'];
        $gender = $row['gender'];
        $category = $row['category'];
        $img1 = $row['img1'];
        $img2 = $row['img2'];
        $img3 = $row['img3'];
        $img4 = $row['img4'];
        $img5 = $row['img5'];
        $img6 = $row['img6'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo "<title>$name</title>";
    ?>
    <!-- <title>Product</title> -->
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
            $(".w-100").click(function() {
                var $index = $(this).parent().index()
                $(".active").attr("src", $(this).attr("src"));
                $(".ecommerce-gallery-main-img").fadeOut(300, function() {
                    $(this).attr("src", $(this).attr("src"));
                }).fadeIn(1000);
                $(".slide").carousel($index);
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btn_add').on('click', function() {
                if ($('input[name="product_size"]:checked').length > 0) {
                    alert("Đã thêm sản phẩm vào giỏ");
                    var product_id = $('#product_id').val();
                    var product_size = $('input[name="product_size"]:checked').val();
                    $.ajax({
                        url: "edit_cart.php",
                        type: "POST",
                        data: {
                            operation: 'add',
                            product_id: product_id,
                            product_size: product_size
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                getCartQuantity();
                            } else if (dataResult.statusCode == 201) {
                                alert("Error occured !");
                            }
                        }
                    });
                } else {
                    alert('Hãy chọn size');
                    $('#btn_add').removeAttr("disabled");
                }
            });
        });
    </script>
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>

    <?php include 'includes/header.php'; ?>

    <main>
        <div class="row">
            <div class="col-12 offset-2">
                <?php
                echo "<h1>$gender > $category</h1>"
                ?>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-2">
            <div class="col-12 col-md-1 offset-md-2">
                <p>

                    [car]7
                    Giặt máy ở nhiệt độ tối đa 30ºC, vắt ở tốc độ thấp
                    [car]14
                    Không sử dụng nước tẩy / thuốc tẩy
                    [car]19
                    Không là
                    [car]28
                    Không giặt khô
                    [car]35
                    Không sử dụng máy sấy
                    [car]62
                    Giặt riêng
                    NGUỒN GỐC
                </p>
            </div>

            <?php
            echo "
                <div class='col-12 col-md-3 offset-md-1'>
                <div id='carouselExampleInterval' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-inner'>
                        <div class='carousel-item active' data-bs-interval='10000'>
                            <img src='$img1' class='d-block w-100'>
                        </div>
                        <div class='carousel-item'>
                            <img src='$img2' class='d-block w-100'>
                        </div>
                        <div class='carousel-item'>
                            <img src='$img3' class='d-block w-100'>
                        </div>
                        <div class='carousel-item'>
                            <img src='$img4' class='d-block w-100'>
                        </div>
                        <div class='carousel-item'>
                            <img src='$img5' class='d-block w-100'>
                        </div>
                        <div class='carousel-item'>
                            <img src='$img6' class='d-block w-100'>
                        </div>
                    </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleInterval' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleInterval' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                    </button>
                </div>
            </div>

            <div class='col-12 col-md-1'>
                <div class='test'>
                    <div style='width: 30%;'>
                        <img src='$img1' data-mdb-img='$img1' alt='Gallery image 1' class='w-100' />
                    </div>
                    <div style='width: 30%;'>
                        <img src='$img2' data-mdb-img='$img2' alt='Gallery image 2' class='w-100' />
                    </div>
                    <div style='width: 30%;'>
                        <img src='$img3' data-mdb-img='$img3' alt='Gallery image 3' class='w-100' />
                    </div>
                    <div style='width: 30%;'>
                        <img src='$img4' data-mdb-img='$img4' alt='Gallery image 4' class='w-100' />
                    </div>
                    <div style='width: 30%;'>
                        <img src='$img5' data-mdb-img='$img5' alt='Gallery image 5' class='w-100' />
                    </div>
                    <div style='width: 30%;'>
                        <img src='$img6' data-mdb-img='$img6' alt='Gallery image 6' class='w-100' />
                    </div>
                </div>
            </div>
            
            <div class='col-12 col-md-2 offset-md-1'>
                <h1>$name</h1>
                <p>$price VND</p>
                <div class='d-grid gap-2'>
                    <form action='add_cart.php' method='post'>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='product_size' id='s' value='s'>
                            <label class='form-check-label' for='s'>S</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='product_size' id='m' value='m'>
                            <label class='form-check-label' for='m'>M</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='product_size' id='l' value='l'>
                            <label class='form-check-label' for='l'>L</label>
                        </div>
                        <input type='hidden' id='product_id' name='product_id' value='$product_id'>
                        <button id='btn_add' class='btn btn-primary' type='button'>Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
                ";
            //     }
            // }
            ?>

        </div>
    </main>
</body>

</html>