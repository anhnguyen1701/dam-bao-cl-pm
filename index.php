<?php
session_start();
include("config.php");

if (!isset($_GET['search'])) {
  $_GET['search'] = "";
}
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

  <script>
  </script>
</head>

<body>
  <?php include 'includes/sidebar.php'; ?>
  <?php include 'includes/header.php'; ?>

  <main>
    <div class="container px-4">
      <form action="" method="GET">
        <div class="input-group mb-3">
          <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                  } ?>" class="form-control" placeholder="Search data">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>

      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 row-cols-1 gx-3 gy-3">
        <?php
        $query = "SELECT category FROM product GROUP BY category";
        $query_run = mysqli_query($conn, $query);
        foreach ($query_run as $item) {
          $cat = $item['category'];
          echo "
          <form action='' method='GET'>
            <input type='hidden' name='filter' value='$cat' id='cat-value'></input>
            <button class='filter' onclick='submitFilter()'>$cat</button>
          </form>
            ";
        }
        ?>
      </div>

      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 row-cols-1 gx-3 gy-3">
        <?php
        if (isset($_GET['filter']) && $_GET['search'] == '') {
          if (isset($_GET['filter'])) {
            $filtervalues = $_GET['filter'];
            $query = "SELECT * FROM product WHERE category='$filtervalues' ";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
              foreach ($query_run as $item) {
                $id = $item['id'];
                $name = $item['name'];
                $price = $item['price'];
                $img1 = $item['img1'];
                $price_text = number_format($price);

                echo "
                <div class='col' id='content'>
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
          }
        } else if (isset($_GET['search'])) {
          $filtervalues = $_GET['search'];
          $query = "SELECT * FROM product WHERE name LIKE '%$filtervalues%' ";
          $query_run = mysqli_query($conn, $query);

          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $item) {
              $id = $item['id'];
              $name = $item['name'];
              $price = $item['price'];
              $img1 = $item['img1'];
              $price_text = number_format($price);

              echo "
              <div class='col' id='content'>
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
        }
        ?>
      </div>
    </div>
  </main>
</body>

</html>