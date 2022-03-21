<?php
session_start();
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="js/sidebar.js"></script>
  <script src="js/func.js"></script>
  <script>
    $(document).ready(function() {
      getTotal();
      $('.img-plus').click(function() {
        var product_id = $(this).parent().parent().children('#product_id').val();
        var product_size = $(this).parent().parent().children('#product_size').val();
        $span_quantity = $(this).siblings('#span_quantity');
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
              getTotal();
              $span_quantity.text(parseInt($span_quantity.text()) + 1);
            } else if (dataResult.statusCode == 201) {
              alert("Error occured !");
            }
          }
        });
      })

      $('.img-minus').click(function() {
        var product_id = $(this).parent().parent().children('#product_id').val();
        var product_size = $(this).parent().parent().children('#product_size').val();
        $span_quantity = $(this).siblings('#span_quantity');
        $card = $(this).parent().parent().parent().parent().parent().parent();
        $.ajax({
          url: "edit_cart.php",
          type: "POST",
          data: {
            operation: 'minus',
            product_id: product_id,
            product_size: product_size
          },
          cache: false,
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $span_quantity.text(parseInt($span_quantity.text()) - 1);
              if ($span_quantity.text() === '0') {
                alert("Đã xóa sản phẩm vào giỏ");
                $card.attr('style', 'display: none');
              }
              getCartQuantity();
              getTotal();
            } else if (dataResult.statusCode == 201) {
              alert("Error occured !");
            }
          }
        });
      })

      $(".img-trash").click(function() {
        var product_id = $(this).parent().parent().children('#product_id').val();
        var product_size = $(this).parent().parent().children('#product_size').val();
        $card = $(this).parent().parent().parent().parent().parent().parent();
        $.ajax({
          url: "edit_cart.php",
          type: "POST",
          data: {
            operation: 'delete',
            product_id: product_id,
            product_size: product_size
          },
          cache: false,
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $card.attr('style', 'display: none');
              alert("Đã xóa sản phẩm vào giỏ");
              getCartQuantity();
              getTotal();
            } else if (dataResult.statusCode == 201) {
              alert("Error occured !");
            }
          }
        });
      });
    });
  </script>
</head>

<body>
  <?php include 'includes/sidebar.php'; ?>

  <?php include 'includes/header.php'; ?>
  

  <main>
    <div class="container px-4">
      <div class="row row-cols-lg-2 row-cols-sm-1 row-cols-1 gx-6 gy-3">
        <?php
        $user_id = $_SESSION['user_id'];
        $query = "SELECT product.id as id, name, price, img1, product_size, product_quantity
                FROM product INNER JOIN cart 
                ON product.id = cart.product_id
                WHERE user_id = $user_id ORDER BY name ASC";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            $img1 = $row['img1'];
            $size = $row['product_size'];
            $quantity = $row['product_quantity'];

            $size_text =  strtoupper($size);
            $price_text = number_format($price);

            echo "
            <div class='col'>
            <div class='card card-left'>
              <div class='row g-0'>
                <div class='col-md-5'>
                  <img src='$img1' class='img-fluid' alt='...'>
                </div>
                <div class='col-md-5'>
                  <div class='card-body'>
                    <input type='hidden' id='product_id' name='product_id' value='$id'>
                    <input type='hidden' id='product_size' name='product_size' value='$size'>
                    <h5 class='card-title'>$name</h5>
                    <p class='card-text my-2'>$price_text VND<br>$size_text</p>
                    <p class='card-text my-3'>
                      <img src='icon/plus.svg' class='img-plus'>
                      <span class='px-3' id='span_quantity'>$quantity</span>
                      <img src='icon/minus.svg' class='img-minus'>
                    </p>
                    <p class='card-text'><img src='icon/trash.svg' class='img-trash'></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
              ";
          }
        }
        ?>
      </div>
    </div>
  </main>
  <nav class="checkout-container container-fluid py-3">
    <p id='p-total'>TỔNG 0 VND</p>
    <a href="checkout.php">
        <button type="button" class="btn btn-dark" style="padding-left: 80px!important; padding-right: 80px!important; margin-left: 30px!important;">THANH TOÁN</button>
    </a>
</nav>
</body>

</html>