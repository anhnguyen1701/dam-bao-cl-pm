<?php
    include("config.php");
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT SUM(product_quantity) sum FROM cart WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $sum = mysqli_fetch_assoc($result)['sum'];
            echo json_encode(array("statusCode" => 200, "sum" => $sum));
        }
        else {
            echo json_encode(array("statusCode" => 201));
        }
    }
?>
