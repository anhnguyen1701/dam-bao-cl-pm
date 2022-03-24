<?php
function generateHeader($conn)
{
    if (isset($_SESSION['user_id'])) {
        $user_name = strtoupper($_SESSION['user_name']);
        $user_id = $_SESSION['user_id'];

        echo
        "<li class='nav-item'><a class='nav-link' href='menu.php'>$user_name</a></li>
            <li class='nav-item'>
                <a class='nav-link' href='logout.php'>ĐĂNG XUẤT</a>
            </li>";
    } else {
        echo
        '<li class="nav-item">
                <a class="nav-link" href="login.php">ĐĂNG NHẬP</a>
            </li>';
    }
}
?>

<header class="fixed-top" style="z-index: 1!important;">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="openbtn" onclick="openNav()">☰</button>
            <a class="navbar-brand" href="admin.php">Management</a>
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