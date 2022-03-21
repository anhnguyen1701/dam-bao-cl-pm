<?php
include("config.php");
session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
//   $product_size = mysqli_real_escape_string($conn, $_POST['product_size']);
//   $user_id = $_SESSION['user_id'];

//   $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND product_size = '$product_size'";
//   $result = mysqli_query($conn, $sql);

//   if (mysqli_num_rows($result) == 0) {
//     $sql = "INSERT INTO `cart` (`user_id`, `product_id`, `product_size`, `product_quantity`) VALUES ('$user_id', '$product_id', '$product_size', 1);";
//     $result = mysqli_query($conn, $sql);
//   } else {
//     $sql = "UPDATE cart SET product_quantity = product_quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND product_size = '$product_size'";
//     $result = mysqli_query($conn, $sql);
  // }

  // if ($result) {
  //   echo json_encode(array("statusCode" => 200));
  // } else {
  //   echo json_encode(array("statusCode" => 201));
  // }
// }
?>
