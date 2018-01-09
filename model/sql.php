<?php
$user = 'admin';
$password = '1234';
$db = 'NTUT_CIVIL_LAB';
$host = 'birdyoserv.ga';
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