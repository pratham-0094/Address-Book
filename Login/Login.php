<?php

include '../config.php';

session_start();

error_reporting(0);

if (isset($_SESSION["username"])) {
  header("Location: ../AddressBook/AddressBook.php");
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pass = md5($_POST['password']);
  $sql = "SELECT * FROM `address_login` WHERE `email`='$email'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] === $pass) {
      $_SESSION['username'] = $row['username'];
      $_SESSION['email'] = $row['email'];
      header("Location: ../AddressBook/AddressBook.php");
    } else {
      // echo "<script>alert('Email or Password is incorrect')</script>";
    }
  } else {
    // echo "<script>alert('accout with this email not exist')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="./Login.css" />
</head>

<body>

  <!-- LOGIN PAGE -->
  <div class="login_page">
    <form action="" method="POST">
      <div class="out">
        <div class="in">
          <h2>Log In</h2>
        </div>
        <div class="in">
          <h4>Welcome to Address Book</h4>
        </div>
        <div class="in">
          <label for="email"><img src="./images/email.png" alt="" /></label>
          <input type="email" value="<?php echo $email; ?>" name="email" id="email" placeholder="Email" autocomplete="off" />
        </div>
        <div class="in">
          <label for="pwd"><img src="./images/password.png" alt="" /></label>
          <input type="password" value="<?php echo $_POST['password']; ?>" name="password" id="pwd" placeholder="Password" autocomplete="off" />
          <img src="./images/eye_close.png" id="show_password" alt="">
        </div>
        <div class="rem">
          <input type="checkbox" name="check" id="box" />
          <label for="box"><a>Remember me</a></label>
        </div>
        <div class="in"><button name="submit" class="loginbtn">Login</button></div>
        <div class="log">
          <h5>Don't have account?</h5>
          <a class="login" href="../SignUp/SignUp.php">Create new</a>
        </div>
      </div>
    </form>
  </div>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./Login.js"></script>
</body>

</html>