<?php
    include("config.php");
    session_start();
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $order_id = $_GET['id'];
        echo '
        <div class="container-fluid">
        ';

        $sql = "SELECT name, status, datetime, address, city, phone, note 
                FROM `orders` WHERE id = $order_id LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
                $status = $row['status'];
                $datetime = $row['datetime'];
                $address = $row['address'];
                $city = $row['city'];
                $phone = $row['phone'];
                $note = $row['note'];

                if ($status == 0) {
                    $status_text = 'Chờ xác nhận';
                } else if ($status == 1) {
                    $status_text = 'Đang giao hàng';
                } else if ($status == 2) {
                    $status_text = 'Đã thanh toán';
                } else if ($status == -1) {
                    $status_text = 'Đã hủy';
                }

                echo "
                    <h6><b>$name</b></h6>
                    <p><b>Trạng thái:</b> $status_text</p>
                    <p><b>Thời gian đặt:</b> $datetime</p>
                    <p><b>Địa chỉ:</b> $address - $city</p>
                    <p><b>SĐT:</b> 0$phone</p>
                    <p><b>Ghi chú:</b> $note</p>
                ";
            }

        }


        echo '
            <table class="table table-hover">
                <thead class="table-dark">
                     <tr>
                        <th scope="col">#</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Size</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
            <tbody>
        ';

        $sql = "SELECT product.name, product_size, product_quantity, product.price 
            FROM order_details INNER JOIN product 
            ON order_details.product_id = product.id
            WHERE order_id = $order_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $i += 1;
                $product_name = $row['name'];
                $product_size = $row['product_size'];
                $product_quantity = $row['product_quantity'];
                $product_price = $row['price'];
                $total += $product_price * $product_quantity;
                echo "
                <tr>
                    <th scope='row'>$i</th>
                    <td>" . $product_name . "</td>
                    <td>" . strtoupper($product_size) . "</td>
                    <td>" . number_format($product_price) . " VND</td>
                    <td>" .$product_quantity . "</td>
                    <td>" .number_format($product_price * $product_quantity)." VND</td>
                </tr>
                ";
            }
            echo "
                <tr>
                    <th scope='row'></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TỔNG:</td>
                    <td>" .number_format($total)." VND</td>
                </tr>
                ";
        }
        else {
            
        }
        echo '
        </tbody>
        </table>
         </div>
        ';

?>
