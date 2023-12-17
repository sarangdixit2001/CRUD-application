<?php
session_start();

?>

<!DOCTYPE html>
<html class="main" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="icon" href="../Images/parklogo-removebg-preview.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  
  </head>
  <body>

    <?php

    include './includes/dbcon.php';

    function input_filter($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['submit'])) {
        $AdminName = input_filter($_POST['AdminName']);
        $AdminPassword = input_filter($_POST['AdminPassword']);

        $AdminName = mysqli_real_escape_string($con, $AdminName);
        $AdminPassword = mysqli_real_escape_string($con, $AdminPassword);

        $query = " SELECT * FROM `admin_login` WHERE `Admin_Name` =? AND `Admin_Password`=?";

        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $AdminName, $AdminPassword);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                session_start();
                $_SESSION['AdminLoginId'] = $AdminName;
                echo '<script>alert(" Welcome ADMIN !!!")</script>';
                header("refresh:0.1 ; url=admin_panel.php");
                //    header("location: admin_panel.php");
            } else {
                echo '<script>alert("Wrong Admin_Name  or pwd!!!")</script>';
            }
            mysqli_stmt_close($stmt);
        } else {
            echo '<script>alert("sql query not prepared")</script>';
        }

        
    }



    ?>



            
</body>




</html>

    
    <div class="wrapper">
      <div class="title"><i class="bi bi-file-person-fill"></i> Admin Log In</div>
      <form action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
     
        <div class="field">
          <input type="text" id="AdminName" name="AdminName" required>
          <label>Employee ID </label>
        </div>
        <div class="field">
          <input type="password" id="pass1" name="AdminPassword" required>
          <label>Password</label>
        </div>
       
        <div class="field">
          <button type="submit" id="btn" name="submit" value="Login">Login</button>
        </div>
        
      </form>      
    </div>
  </body>
</html>

