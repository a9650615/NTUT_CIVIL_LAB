<?php
$user = 'root';
$password = '';
$db = 'NTUT_CIVIL_LAB';
$host = 'birdyoserv.ga';
$port = 3307;
//$socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';

$link = mysqli_init();
$success = mysqli_real_connect(
   $link, 
   $host,
   $user, 
   $password, 
   $db,
   $port
   //$socket
);