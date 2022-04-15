<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=notehub','root','1111');
$user = $_POST["user_idr"];
$pass = $_POST["passwordr"];
// check user and pass for sql
$return = $db->query("INSERT INTO users (username,password) VALUES ('$user','$pass')");
$return = $return->fetchAll();
$_SESSION['username'] = $user;
header("Location: http://localhost:8080/dashboard.php");
?>