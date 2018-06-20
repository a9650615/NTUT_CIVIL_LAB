<?php
$user = 'admin';
$password = '1234';
$db = 'civil';
$host = '192.168.1.2';
$port = 3307;
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