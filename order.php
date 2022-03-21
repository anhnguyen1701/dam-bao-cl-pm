<?php
include("config.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Playfair Display" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/func.js"></script>
    <script>
        $(document).ready(function() {
            $('.a_order_detail').click(function() {
                var myModal = new bootstrap.Modal(document.getElementById('order_detail_modal'), {
                    keyboard: false
                });
                var order_id = $(this).siblings('#order_id').val();
                $order_detail_table = $('#order-detail-body');
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    $order_detail_table.html(this.responseText);
                    myModal.show();
                }
                xhttp.open("GET", "get_order_detail.php?id=" + order_id);
                xhttp.send();
            })
        })
    </script>
</head>

<body>

    <?php include 'includes/sidebar.php'; ?>

    <?php include 'includes/header.php'; ?>

    <!-- The Modal -->
    <div class="modal fade" id="order_detail_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid" id="order-detail-body">
                      
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <main class="main-menu">
        <div class="row">
            <?php include 'includes/menu_sidebar.php' ?>

            <div class="col-lg-8 col-md-12">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT id, datetime, total, status FROM `orders` WHERE user_id = $user_id ORDER BY datetime DESC";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $i += 1;
                                $order_id = $row['id'];
                                $datetime = $row['datetime'];
                                $total = $row['total'];
                                $status = $row['status'];

                                $total_text = number_format($total) . ' VND';
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
                            <tr>
                            <th scope='row'>$i</th>
                            <td>" . substr($datetime, 0, 10) . "</td>
                            <td>$total_text</td>
                            <td>$status_text</td>
                            <td>
                                <input type='hidden' id='order_id' name='order_id' value='$order_id'>
                                <a class='a_order_detail' style='text-decoration: underline!important;'>Xem chi tiết</a>
                            </td>
                            </tr>
                            ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>