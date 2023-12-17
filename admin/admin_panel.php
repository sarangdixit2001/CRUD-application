<?php

require("./includes/dbcon.php");

session_start();
session_regenerate_id(true);
if (!isset($_SESSION['AdminLoginId'])) {

    echo '<script>alert("Please Login Admin !!")</script>';
    header("refresh:0.1 ; url= admin_login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Admin</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="icon" href="../Images/parklogo-removebg-preview.png" type="image/icon type">
 
</head>
<body>
	<div class="banner">
		<div class="navbar">
			
			<ul>
            <li><a href="admin_panel.php">Home</a></li>
                <div class="dropdown">
                <li><a href="./manage-user.php">Manage User</a></li>
			</ul>
		</div>
		<div class="content">
			<script>alert("Welcome Admin <?php echo $_SESSION['AdminLoginId'] ?>")</script>
		</div>
	</div>

<style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
	</body>
</html>


