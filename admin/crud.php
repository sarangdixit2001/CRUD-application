<?php

require("./includes/dbcon.php");

session_start();
session_regenerate_id(true);
if (!isset($_SESSION['AdminLoginId'])) {

    echo '<script>alert("Please Login Admin !!")</script>';
    header("refresh:0.1 ; url= ../admin_login.php");
}

function row_remove($img){
    if(unlink($img)){
        
        header("location: manage_user.php?alert=img_rem_fail");
        exit;

    }
    
}

// DELETE Operation
if(isset($_GET['rem']) && $_GET['rem']>0)
{
    $query="SELECT * FROM `form_detail` WHERE `id`='$_GET[rem]' ";
    
    $result=mysqli_query($con,$query);
    $fetch=mysqli_fetch_assoc($result);


    row_remove($fetch['time']);

    $query="DELETE FROM `form_details` WHERE `id`='$_GET[rem]'";
    if(mysqli_query($con,$query)){
        header("location: ./manage-user.php?success=removed");
    }
    else{
        header("location: ./manage_user.php?alert=remove_failed");
    }
}



//Update Operation

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $hobbies = $_POST['hobbies'];
    $profilepic = $_POST['profilepic'];

    $query = "UPDATE `form_details` SET Name='$name', Gender='$gender', DOB='$dob', Address='$address', Hobbies='$hobbies', profilepic='$profilepic' WHERE id=$id";

    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location: ./edit-user.php?success=updated");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    echo "User Details Updated";
}
?>