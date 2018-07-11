<?php
$user = 'root';
$password = 'root';
$db = 'civil';
$host = '127.0.0.1';
$port = 8889;
// $socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';

$conn = mysqli_init();
$is_link = mysqli_real_connect(
   $conn, 
   $host,
   $user, 
   $password, 
   $db,
   $port
//    $socket
);
// if (!$link) {
//     echo 'sql error 1';
// }

// if (!$conn) {
//     echo 'die2';
// }

$admin = 4;