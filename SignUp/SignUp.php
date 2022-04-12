<?php

include '../config.php';

session_start();

error_reporting(0);

if (isset($_SESSION["username"])) {
  header("Location: ../AddressBook/AddressBook.php");
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cfrmpassword']);

  if ($password == $cpassword) {
    $sql = "SELECT * FROM `address_login` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (!($result->num_rows > 0)) {
      $sql = "INSERT INTO `address_login` ( `username`, `email`, `password`, `date`) VALUES ('$username', '$email', '$password', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        // echo "<script>alert('something went wrong')</script>";
      } else {
        // echo "<script>alert('successfully registered')</script>";
        $_SESSION['username'] = $username;
        $_POST['username'] = "";
        $_POST['email'] = "";
        $_POST['password'] = "";
        $_POST['cfrmpassword'] = "";
        header("Location: ../AddressBook/AddressBook.php");
      }
    } else {
      // echo "<script>alert('Email already exist')</script>";
    }
  } else {
    // echo "<script>alert('password not matched')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SignUp</title>
  <link rel="stylesheet" href="./SignUp.css" />
</head>

<body>

  <!-- SIGNUP PAGE -->
  <div class="sign_page">
    <form action="" method="POST">
      <div class="out">
        <div class="in">
          <h2>Sign Up</h2>
        </div>
        <div class="in">
          <h4>Welcome to Address Book</h4>
        </div>
        <div class="in">
          <label for="username"><img src="./images/username.png" alt="" /></label>
          <input type="text" value="<?php echo $username; ?>" name="username" id="username" placeholder="Username" autocomplete="off"/>
        </div>
        <div class="in">
          <label for="email"><img src="./images/email.png" alt="" /></label>
          <input type="email" value="<?php echo $email; ?>" name="email" id="email" placeholder="Email" autocomplete="off"/>
        </div>
        <div class="in">
          <label for="pwd"><img src="./images/password.png" alt="" /></label>
          <input type="password" value="<?php echo $_POST['password']; ?>" name="password" id="pwd" placeholder="Password" />
          <img src="./images/eye_close.png" id="show_password" alt="" />
        </div>
        <div class="in">
          <label for="cfrmpwd"><img src="./images/cfrpwd.png" alt="" /></label>
          <input type="password" value="<?php echo $_POST['cfrmpassword']; ?>" name="cfrmpassword" id="cfrmpwd" placeholder="Confirm Password" />
        </div>
        <div class="in">
          <button name="submit" class="signupbtn" onclick="return Validate()">REGISTER</button>
        </div>
        <div class="log">
          <h5>Already have an account?</h5>
          <a class="signup" href="../Login/Login.php">Log in</a>
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
  <script src="./SignUp.js"></script>
</body>

</html>