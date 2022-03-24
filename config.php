<?php
define('DB_SERVER', 'us-cdbr-east-05.cleardb.net');
define('DB_USERNAME', 'bf8b06d1f27ab6');
define('DB_PASSWORD', '034ed77b');
define('DB_DATABASE', 'heroku_31fc207ed1cb063');
$conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
mysqli_set_charset($conn, 'utf8mb4');

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_DATABASE', 'lap_trinh_web');
// $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$conn) {
   die('khong the ket noi database:');
}

mysqli_set_charset($conn, 'utf8mb4');
