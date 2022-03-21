<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT product.price as price, cart.product_quantity as quantity FROM `cart` INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $total = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $total += intval($row['price']) * intval($row['quantity']);
        }
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    $total = number_format($total);

    if ($result) {
        echo json_encode(array("statusCode" => 200, "total" => $total));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}
