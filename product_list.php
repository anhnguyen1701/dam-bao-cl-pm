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
  <title>E-commerce</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="js/sidebar.js"></script>
</head>

<body>
  <?php include 'includes/sidebar.php'; ?>

  <?php include 'includes/header.php'; ?>

  <main>
    <div class="container px-4">
      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 row-cols-1 gx-3 gy-3">

        <?php
          $gender = $_GET['g'];
          $category = $_GET['c'];
          $query = "SELECT * FROM product WHERE gender = '$gender' AND category = '$category'";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              $id = $row['id'];
              $name = $row['name'];
              $price = $row['price'];
              $img1 = $row['img1'];
              $price_text = number_format($price);

              echo "
              <div class='col'>
              <a href='product.php?p=$id'>
                <div class='card card-top'>
                  <img src='$img1' class='card-img-top'>
                  <div class='card-body'>
                    <h5 class='card-title'>$name</h5>
                    <p class='card-text'>$price_text VND</p>
                  </div>
                </div>
              </a>
            </div>
              ";
            }
          }
        ?>

        
      </div>
    </div>
  </main>
</body>

</html>