<?php   
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $dsn = 'mysql:dbname=UserDB;host=192.168.8.101';
    $user = 'root';
    $pw = 'Sumafelo03!';
    $con = new PDO($dsn, $user, $pw);
?>