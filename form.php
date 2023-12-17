<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>User Form</title>
    <link rel="stylesheet" href="#">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65));
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        .container {
            margin-top: 50px;
            margin-left: 270px;
            max-width: 885px;
            width: 90%;
            height: 120%;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .container .title {
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

        .container .title::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .content form .user-details {
            padding: 0 10px;
            /* Adjusted for better spacing */
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input,
        .user-details .input-box textarea,
        .user-details .input-box fieldset {
            width: 100%;
            /* Adjusted for full width */
        }

        .user-details .input-box textarea {
            height: 80px;
        }

        .user-details .input-box fieldset {
            margin-top: 10px;
        }

        form .button {
            padding-left: 10px;
            /* Adjusted for better spacing */
            padding-right: 10px;
            /* Adjusted for better spacing */
            height: 45px;
            margin: 20px 0;
        }

        form .button input {
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

        form .button input:active {
            transform: scale(0.99);
            background: linear-gradient(-135deg, #c850c0, #4158d0);
        }

        @media(max-width: 768px) {
            .user-details .input-box {
                width: 100%;
            }
        }

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }

            .user-details {
                padding: 0 10px;
            }

            .content form .user-details {
                max-height: 300px;
                overflow-y: scroll;
            }

            .user-details::-webkit-scrollbar {
                width: 5px;
            }
        }

        @media(max-width: 459px) {
            .container .content .category {
                flex-direction: column;
            }
        }

        #btn {
            border-radius: 5px;
            padding: 10px 20px;
            /* Adjusted for better spacing */
            cursor: pointer;
            background-color: #5f56cd;
            margin-left: 380px;
            margin-top: 1px;
            color: white;
            border-color: #fff;
        }

        .signup-link {
            margin-top: 25px;
            margin-left: 20px;
        }
    </style>

<body>


    <?php

    include('./includes/dbcon.php');

    if (isset($_POST['submit'])) {
        $Name = mysqli_real_escape_string($con, $_POST['Name']);
        $Gender = mysqli_real_escape_string($con, $_POST['Gender']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $Address = mysqli_real_escape_string($con, $_POST['Address']);
        $Hobbies = implode(', ', $_POST['Hobbies']);

        // If upload button is clicked ...
        if (isset($_POST['upload'])) {

            $profilepic = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "./img/profilepic" . $profilepic;



            // Get all the submitted data from the form
            $sql = "INSERT INTO form_details (profilepic) VALUES ('$profilepic')";




            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
        }




        $query = "INSERT INTO form_details (Name, Gender, DOB, Address, Hobbies, profilepic) VALUES ('$Name', '$Gender', '$DOB', '$Address', '$Hobbies', '$profilepic')";

        if (mysqli_query($con, $query)) {
            echo "<script>alert('User details added successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'form.php'; </script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    }

    ?>

    <div class="container">
        <div class="title"><i class="bi bi-person-lines-fill"></i> User Form</div>
        <div class="content">
            <form action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" id="name" name="Name" placeholder="Enter your name" pattern="[a-zA-Z'-'\s]*" required="" oninvalid="this.setCustomValidity('Please Enter Valid Name')" oninput="setCustomValidity('')">
                    </div>
                    <div class="input-box">
                        <span class="details">Gender</span>
                        <div>
                            <input type="radio" id="male" name="Gender" value="male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="Gender" value="female" required>
                            <label for="female">Female</label>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">Date of Birth</span>
                        <input type="date" id="dob" name="DOB" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <textarea id="address" name="Address" rows="6" required></textarea>
                    </div>
                    <div class="input-box">
                        <span class="details">Hobbies</span>
                        <fieldset>
                            <legend>Hobbies:</legend>
                            <input type="checkbox" id="reading" name="Hobbies[]" value="reading">
                            <label for="reading">Reading</label>

                            <input type="checkbox" id="writing" name="Hobbies[]" value="writing">
                            <label for="writing">Writing</label>

                            <input type="checkbox" id="drawing" name="Hobbies[]" value="drawing">
                            <label for="drawing">Drawing</label>
                            <!-- Add more checkboxes for additional hobbies as needed -->
                        </fieldset>
                    </div>
                    <div class="input-box">
                        <span class="details">Add Profile Picture</span>
                        <input type="file" id="profilepic" name="profilepic" accept="image/*" required>
                    </div>

                </div>
                <div class="btn">
                    <button type="submit" id="btn" name="submit" value="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>