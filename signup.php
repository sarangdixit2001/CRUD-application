<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Registration</title>
  <link rel="stylesheet" href="#">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<style>
    
/*SignUp page css start*/
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  width: 100%;
  height: 100vh;
 
  justify-content: center;
  align-items: center;
  
  background-image: linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65));
  background-repeat: no-repeat;
  background-position: center;
  background-size:contain;
}
.navbar{
  width: 100%;
  margin: auto;
  padding: 5px 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color:transparent;
  border-radius: 25px;
}
.logo{
  width: 120px;
  cursor: pointer;
  margin-left: 50px;
  border-radius: 25px;
}
.navbar ul li{
  font-size: 20px;
  list-style: none;
  display: inline-block;
  margin: 0 20px;
}
.navbar ul li a{
  margin: 0px 20px 0px 0px;
  text-decoration: none;
  color:#ccdcff;
}
.navbar ul li a:hover {
  color:#e6eeff;
}
.container{
  margin-top: 20px;
  margin-left: 450px;
  max-width: 700px;
  width: 80%;
  height: 80%;
  background-color: #fff;
  
  border-radius: 15px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
}
.container .title{
  position: relative;
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  line-height: 100px;
  color: #fff;
  user-select: none;
  border-radius: 15px 15px 0 0;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: linear-gradient(135deg, #71b7e6, #9b59b6);
}
.content form .user-details{
  padding: 0 30px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #9b59b6;
}


 form .button{
  padding-left: 150px;
  padding-right: 150px;
   height: 45px;
   margin: 35px 0;
 }
 form .button input{
   height: 100%;
   width: 100%;
   justify-content: center;
   text-align: center;
   position: relative;
   border-radius: 25px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: linear-gradient(-135deg, #c850c0, #4158d0);
 }
 form .button input:active{
  transform: scale(0.99); 
  background: linear-gradient(-135deg, #c850c0, #4158d0);
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
}
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .user-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar{
    width: 5px;
  }
  }
  @media(max-width: 459px){
  .container .content .category{
    flex-direction: column;
  }
}
#btn{
  border-radius: 5px;
  padding: 10px 128px;
  cursor: pointer;
  background-color: #5f56cd;
  margin-left: 205px;
  margin-top: 45px;
  color: white;
  border-color: #fff;
}
.signup-link{
  margin-top: 25px;
    margin-left: 218px;
}
/*SignUP page css End*/
</style>

<body>

<?php
include './includes/dbcon.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    $emailquery = "SELECT * FROM user WHERE email = '$email'";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);

    $usernamequery = "SELECT * FROM user WHERE username ='$username'";
    $uquery = mysqli_query($con, $usernamequery);
    $usernamecount = mysqli_num_rows($uquery);

    if ($usernamecount > 0) {
        echo '<script>alert("Username already taken!")</script>';
    } elseif ($emailcount > 0) {
        echo '<script>alert("Email already registered!")</script>';
    } else {
        if ($password === $cpassword) {
            $insertquery = "INSERT INTO user (name, username, email, contact_no, password, cpassword) VALUES ('$name', '$username', '$email', '$contact_no', '$pass', '$cpass')";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
            echo "<script>alert('Registration Successful! You can now login.');
            window.location.href= 'signin.php';</script>";
            } else {
                echo '<script>alert("Registration failed! Please try again. ' . mysqli_error($con) . '")</script>';
            }
        } else {
            echo '<script>alert("Password not matching!")</script>';
        }
    }
}
?>


  
  <div class="container">
    <div class="title"><i class="bi bi-person-lines-fill"></i> Registration</div>
    <div class="content">
      <form action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" id="name" name="name" placeholder="Enter your name" pattern="[a-zA-Z'-'\s]*" required="" oninvalid="this.setCustomValidity('Please Enter Valid Name')" oninput="setCustomValidity('')">
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Contact Number</span>
            <input type="text" id="phnumber" name="contact_no" placeholder="Enter your number" pattern="^[7-9]\d{9}$" maxlength="10" required="" oninvalid="this.setCustomValidity('Please Enter Valid Number 9/8/7')" oninput="setCustomValidity('')">
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id="pass1" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" id="pass2" name="cpassword" placeholder="Confirm your password" required>
          </div>
         
        </div>
        <div class="btn">
          <button type="submit" id="btn" name="submit" value="register">Register</button>
        </div>
        <div class="signup-link">Already have a account ! <a href="./signin.php">Login here</a></div>
      </form>
    </div>
  </div>

</body>

</html>