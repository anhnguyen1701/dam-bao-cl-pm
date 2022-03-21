<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operation = $_POST['operation'];
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_size = mysqli_real_escape_string($conn, $_POST['product_size']);
    $user_id = $_SESSION['user_id'];

    $sql_select = "SELECT product_quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND product_size = '$product_size' LIMIT 1";
    $result_select = mysqli_query($conn, $sql_select);

    $quantity = mysqli_fetch_assoc($result_select)['product_quantity'];
    if ($operation === 'minus' && $quantity == 1) {
        $operation = 'delete';
    }

    if (mysqli_num_rows($result_select) == 0 && $operation !== 'add') {
        echo json_encode(array("statusCode" => 201));
    } elseif (mysqli_num_rows($result_select) == 0 && $operation === 'add') {
        $sql = "INSERT INTO `cart` (`user_id`, `product_id`, `product_size`, `product_quantity`) VALUES ('$user_id', '$product_id', '$product_size', 1);";
    } elseif ($operation === 'add') {
        $sql = "UPDATE cart SET product_quantity = product_quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND product_size = '$product_size'";
    }elseif ($operation === 'minus') {
        $sql = "UPDATE cart SET product_quantity = product_quantity - 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND product_size = '$product_size'";
    } elseif ($operation === 'delete') {
        $sql = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND product_size = '$product_size'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }

    // if ($operation === 'minus'  && mysqli_fetch_assoc($result)['product_quantity'] <= 0) {
    //     $sql = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    //     $result = mysqli_query($conn, $sql);
    // }
}
