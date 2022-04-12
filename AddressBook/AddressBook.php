<?php

include '../config.php';

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: ../Login/Login.php");
}

error_reporting(0);

$email = $_SESSION["email"];
$sql = "SELECT * FROM `address_login` WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$owner = $row["serial"];

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $remail = $_POST['remail'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $sql = "INSERT INTO `my_address` ( `name`, `owner`, `email`, `phone`, `address`, `date`) VALUES ('$name', '$owner','$remail', '$phone', '$address', current_timestamp());";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    // echo "<script>alert('something went wrong')</script>";
  } else {
    // echo "<script>alert('successfully registered')</script>";
    $_POST['name'] = "";
    $_POST['remail'] = "";
    $_POST['phone'] = "";
    $_POST['address'] = "";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="AddressBook.css" />
</head>

<body>

  <!-- NAVBAR -->
  <div class="navbar">
    <nav>
      <div>
        <ul>
          <li id="home">HOME</li>
          <li id="search">SEARCH</li>
          <li id="contact">CONTACTS</li>
        </ul>
      </div>
      <div>
        <a href="../logout.php"> <button class="logout">
            <img src="./images/exit.png" alt="" /> Log out
          </button></a>
      </div>
    </nav>
  </div>

  <!-- FORM -->
  <div class="add_box">
    <h1>Address book</h1>
    <form action="" method="POST">
      <div class="contact ">
        <label for="name"></label>
        <input type="text" name="name" id="name" placeholder="Name" />
      </div>
      <div class="contact ">
        <label for="remail"></label>
        <input type="text" name="remail" id="remail" placeholder="Email" />
      </div>
      <div class="contact ">
        <label for="phone"></label>
        <input type="number" name="phone" id="phone" placeholder="Phone No." />
      </div>
      <div class="contact ">
        <label for="address"></label>
        <textarea type="" rows="3" cols="41" name="address" id="address" placeholder="Address"></textarea>
      </div>
      <div class="contact "><button name="submit" class="add" id="add">ADD</button></div>
    </form>
  </div>

  <!-- SEARCH -->
  <div class="search_box d-none">
    <div>
      <form action="" method="POST">
        <h1>SEARCH</h1>
        <div class="search">
          <label for="search_name"></label>
          <input type="text" name="search_name" id="search_name" placeholder="SEARCH" />
        </div>
        <div class="contact">
          <button name="search" class="search">
            <img src="./images/search.png" alt="" />
          </button>
        </div>
      </form>
    </div>
    <div>
      <?php

      if (isset($_POST['search'])) {
        $sname = $_POST['search_name'];
        $query = "SELECT * FROM `my_address` WHERE name='$sname'"; //You don't need a ; like you do in SQL
        $display = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($display)) {   //Creates a loop to loop through results
          echo "<div class='my_address'><ul><li>" . $row['name'] . "</li><li>" . $row['email'] . "</li><li>" . $row['phone'] . "</li><li>" . $row['address'] . "</li></ul></div>";
        }
      }

      ?>
    </div>
  </div>

  <!-- DISPLAY -->
  <div class="display_box d-none">
    <?php

    $query = "SELECT * FROM `my_address` WHERE owner='$owner'"; //You don't need a ; like you do in SQL
    $display = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($display)) {   //Creates a loop to loop through results
      echo "<div class='my_address'><div class='main'><ul><li>" . $row['name'] . "</li><li>" . $row['email'] . "</li><li>" . $row['phone'] . "</li><li>" . $row['address'] . "</li></ul></div><div class='change'><a href='delete.php?deleteid=" . $row['serial'] . "' id='delete'><img src='./images/delete.png' /></a><a href='edit.php?editid=" . $row['serial'] . "' id='edit'><img src='./images/edit.png' /></a></div></div>";
    }
    ?>
  </div>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./AddressBook.js"></script>
</body>

</html>