<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "addressbook";
$conn = mysqli_connect($server, $user, $pass, $database);


if (!$conn) {
    die("<script>alert('connection failed'. mysqli_connect_error()).</script>");
  }
  
?>