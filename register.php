<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $myemail = mysqli_real_escape_string($conn, $_POST['email']);
  $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
  $mylastname = mysqli_real_escape_string($conn, $_POST['lastName']);
  $myfirstname = mysqli_real_escape_string($conn, $_POST['firstName']);
  $mycity = mysqli_real_escape_string($conn, $_POST['city']);
  $myaddress = mysqli_real_escape_string($conn, $_POST['address']);
  $myphone = mysqli_real_escape_string($conn, $_POST['phone']);

  $sql = "INSERT INTO `user` (`id`, `email`, `password`, `lastName`, `firstName`, `city`, `address`, `phone`) VALUES (NULL, '$myemail', '$mypassword', '$mylastname', '$myfirstname', '$mycity', '$myaddress', '$myphone');";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $_SESSION['login_user'] = $myfirstname;
    header("location: login.php");
  } else {
    $error = "Your Login Name or Password is invalid";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Playfair Display" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/sidebar.js"></script>
</head>

<body>
  <?php include 'includes/sidebar.php'; ?>

  <?php include 'includes/header.php'; ?>

  <main class="main-login">
    <div class="row justify-content-around">
      <div class="col-lg-4">
        <form method="POST" action="register.php">
          <div class="mb-3">
            <h2>????NG K??</h2>
            <label for="inputEmail" class="form-label">?????A CH??? EMAIL</label>
            <input type="email" name="email" class="form-control" id="inputEmail">
          </div>
          <div class="mb-3">
            <label for="inputPassword" class="form-label">M???T KH???U</label>
            <input type="password" name="password" class="form-control" id="inputPassword">
          </div>
          <div class="mb-3">
            <label for="inputLastName" class="form-label">H???</label>
            <input type="text" name="lastName" class="form-control" id="inputLastName">
          </div>
          <div class="mb-3">
            <label for="inputFirstName" class="form-label">T??N</label>
            <input type="text" name="firstName" class="form-control" id="inputFirstName">
          </div>
          <div class="mb-3">
            <label for="inputCity" class="form-label">T???NH/ TH??NH PH???</label><br>
            <select class="form-select" id="inputCity" name="city">
              <option value="H?? N???i">H?? N???i</option>
              <option value="TP. H??? Ch?? Minh">TP. H??? Ch?? Minh</option>
              <option value="fiat">Hehe</option>
              <option value="audi">Haha</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="inputAddress" class="form-label">?????A CH???</label>
            <input type="text" name="address" class="form-control" id="inputAddress">
          </div>
          <div class="mb-3">
            <label for="inputPhone" class="form-label">S??? ??I???N THO???I</label>
            <input type="tel" name="phone" class="form-control" id="inputPhone">
          </div>
          <button type="submit" name="register" class="btn btn-primary">????NG K??</button>
        </form>
      </div>
      <div class="col-lg-3">
        <h2>????NG NH???P</h2>
        <p>N???U QU?? KH??CH ???? C?? T??I KHO???N TR??N ZARA.COM, H??Y ????NG NH???P.</p>
        <a href="login.php" class="btn btn-primary">????NG NH???P</a>
      </div>
    </div>
  </main>
</body>

</html>