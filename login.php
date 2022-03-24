<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $myemail = mysqli_real_escape_string($conn, $_POST['email']);
  $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT id, role, firstName FROM user WHERE email = '$myemail' and password = '$mypassword'";
  $result = $conn->query($sql);

  $count = mysqli_num_rows($result);

  if ($result->num_rows == 1) {
    $row = mysqli_fetch_array($result);
    $id = $row["id"];
    $role = $row["role"];
    $myfirstname = $row["firstName"];
    $_SESSION['user_name'] = $myfirstname;
    $_SESSION['user_id'] = $id;
    $_SESSION['user_role'] = $role;

    if($_SESSION['user_role'] == 'user') {
      header("location: index.php");
    } else if($_SESSION['user_role'] == 'admin') {
      header("location: admin.php");
    }

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
        <form method="POST" action="login.php">
          <div class="mb-3">
            <h2>ĐĂNG NHẬP</h2>
            <label for="exampleInputEmail1" class="form-label">ĐỊA CHỈ EMAIL</label>
            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">MẬT KHẨU</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" name="login" class="btn btn-primary">ĐĂNG NHẬP</button>
        </form>
      </div>
      <div class="col-lg-3">
        <h2>ĐĂNG KÝ</h2>
        <p>NẾU QUÝ KHÁCH VẪN CHƯA CÓ TÀI KHOẢN TRÊN ZARA.COM, HÃY SỬ DỤNG TÙY CHỌN NÀY ĐỂ TRUY CẬP BIỂU MẪU ĐĂNG KÝ.</p>
        <p>BẰNG CÁCH CUNG CẤP CHO CHÚNG TÔI THÔNG TIN CHI TIẾT CỦA QUÝ KHÁCH, QUÁ TRÌNH MUA HÀNG TRÊN ZARA.COM SẼ LÀ MỘT TRẢI NGHIỆM THÚ VỊ VÀ NHANH CHÓNG HƠN.</p>
        <a href="register.php" class="btn btn-primary">TẠO TÀI KHOẢN</a>
      </div>
    </div>
  </main>
</body>

</html>