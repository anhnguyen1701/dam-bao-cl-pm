<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);

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

    $sql = "INSERT INTO `orders` (`id`, `user_id`, `name`, `phone`, `city`, `address`, `note`, `total`) VALUES (NULL, '$user_id', '$name', '$phone', '$city', '$address', '$note', '$total')";
    if (mysqli_query($conn, $sql)) {
        $orders_id = mysqli_insert_id($conn);
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201, "error" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
    }

    $sql = "INSERT INTO order_details(order_id, product_id, product_size, product_quantity)
            SELECT $orders_id, product_id, product_size, product_quantity FROM cart WHERE cart.user_id = '$user_id';";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
    mysqli_query($conn, $sql);
}
