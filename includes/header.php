<?php
    function generateHeader($conn) {
        if (isset($_SESSION['user_id'])) {
            $user_name = strtoupper($_SESSION['user_name']);
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT SUM(product_quantity) as sum FROM cart WHERE user_id = $user_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sum = mysqli_fetch_assoc($result)['sum'];
                if (!$sum) {
                    $sum = 0;
                }
            }

            echo
            "<li class='nav-item'><a class='nav-link' href='menu.php'>$user_name</a></li>
            <li class='nav-item'>
                <a class='nav-link' href='logout.php'>ĐĂNG XUẤT</a>
            </li>
            <li class='nav-item'>
                <a id='cart-link' class='nav-link' href='cart.php'>GIỎ (<span id='span-sum'>$sum</span>)</a>
            </li>";
        } else {
            echo
            '<li class="nav-item">
                <a class="nav-link" href="login.php">ĐĂNG NHẬP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">ĐĂNG KÝ</a>
            </li>';
        }
    }
?>

<header class="fixed-top" style="z-index: 1!important;">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="openbtn" onclick="openNav()">☰</button>
            <a class="navbar-brand" href="index.php">Zara</a>
            <ul class="navbar-nav d-flex">
                <?php
                // include('config.php');
                // session_start();
                generateHeader($conn);
                ?> 
            </ul>
        </div>
    </nav>
</header>