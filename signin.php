<?php
session_start();

?>

<!DOCTYPE html>
<html class="main" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="icon" href="../Images/parklogo-removebg-preview.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  </head>
  <body>


    
  <?php

include './includes/dbcon.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = " select * from user where email= '$email'";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if ($email_count) {

        $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['password'];

        $_SESSION['name'] = $email_pass['name'];
        $_SESSION['username'] = $email_pass['username'];
        $_SESSION['email'] = $email_pass['email'];
        $_SESSION['contact_no'] = $email_pass['contact_no'];

        $pass_decode = password_verify($password, $db_pass);

        if ($pass_decode) {
            
            echo '<script>alert("Welcome \n Login Successfull !!!")</script>';
            header("refresh:0.1 ; url=form.php");
        } else {
            echo '<script>alert("Wrong Password !!!")</script>';
        }
    } else {
        echo '<script>alert("Wrong Email !!!")</script>';
    }
}

?>

    
    <div class="wrapper">
      <div class="title"><i class="bi bi-person-circle"></i> Log In</div>
      <form action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
     
        <div class="field">
          <input type="text" id="email" name="email" required>
          <label>Email</label>
        </div>
        <div class="field">
          <input type="password" id="pass1" name="password" required>
          <label>Password</label>
        </div>
       
        <div class="field">
          <button type="submit" id="btn"name="submit" value="Login">Login</button>
        </div>
        <div class="signup-link">Not a member? <a href="./signup.php">Signup now</a></div>
      </form>      
    </div>
  </body>
</html>

