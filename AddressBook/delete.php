<?php

session_start();

include "../config.php";

if (!isset($_SESSION["username"])) {
  header("Location: ../Login/Login.php");
}

if (!isset($_GET["deleteid"])) {
  header("Location: ../AddressBook/AddressBook.php");
}

$serial=$_GET['deleteid'];
$sql = "DELETE FROM `my_address` WHERE `serial`='$serial'";
mysqli_query($conn, $sql);

header("Location: ../AddressBook/AddressBook.php");

?>