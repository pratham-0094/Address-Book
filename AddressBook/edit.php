<?php

session_start();

error_reporting(0);

include "../config.php";

if (!isset($_SESSION["username"])) {
  header("Location: ../Login/Login.php");
}

if (!isset($_GET["editid"])) {
  header("Location: ../AddressBook/AddressBook.php");
}

$serial = $_GET['editid'];
$sql = "SELECT * FROM `my_address` WHERE `serial`='$serial'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$address = $row['address'];

if (isset($_POST['update'])) {
  $rname = $_POST['name'];
  $remail = $_POST['remail'];
  $rphone = $_POST['phone'];
  $raddress = $_POST['address'];
  $edit = "UPDATE `my_address` SET `name`='$rname',`email`='$remail',`phone`='$rphone',`address`='$raddress',`date`= current_timestamp() WHERE `serial`='$serial'";
  $update = mysqli_query($conn, $edit);
  if (!$update) {
    // echo "<script>alert('something went wrong')</script>";
  } else {
    // echo "<script>alert('successfully registered')</script>";
    $_POST['name'] = "";
    $_POST['remail'] = "";
    $_POST['phone'] = "";
    $_POST['address'] = "";
    header("Location: ../AddressBook/AddressBook.php");
  }
}


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
  <link rel="stylesheet" href="./AddressBook.css">
</head>

<body>
 <!-- NAVBAR -->
 <div class="navbar">
    <nav>
      <div>
        <ul>
          <li id="home"><a href="">HOME</a></li>
          <li id="search"><a href="">SEARCH</a></li>
          <li id="contact"><a href="">CONTACTS</a></li>
        </ul>
      </div>
      <div>
        <a href="../logout.php"> <button class="logout">
            <img src="./images/exit.png" alt="" /> Log out
          </button></a>
      </div>
    </nav>
  </div>


  <div class="add_box">
    <h1>UPDATE THE ADDRESS</h1>
    <form action="" method="POST">
      <div class="contact ">
        <label for="name"></label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Name" />
      </div>
      <div class="contact ">
        <label for="remail"></label>
        <input type="text" name="remail" id="remail" value="<?php echo $email; ?>" placeholder="Email" />
      </div>
      <div class="contact ">
        <label for="phone"></label>
        <input type="number" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Phone No." />
      </div>
      <div class="contact ">
        <label for="address"></label>
        <textarea type="" rows="3" cols="41" name="address" value="<?php echo $address; ?>" id="address" placeholder="Address"></textarea>
      </div>
      <div class="contact "><button name="update" class="add" id="add">UPDATE</button></div>
    </form>
  </div>


  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>