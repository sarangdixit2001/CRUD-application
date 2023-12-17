<?php

require("./includes/dbcon.php");

session_start();
session_regenerate_id(true);
if (!isset($_SESSION['AdminLoginId'])) {

    echo '<script>alert("Please Login Admin !!")</script>';
    header("refresh:0.1 ; url= ../admin_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <!-- CSS only -->
    <link rel="stylesheet" href="../admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<title>All User </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>


<header class="header">




</header>

<body>
    <div class="banner">




        <div class="bg">
            <div class="container bg-dark text-light p-3 rounded my-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h2><i class="bi bi-file-earmark-person-fill"></i> Manage User Details</h2>


                </div>
            </div>
            <?php

            if (isset($_GET['alert'])) {
                if ($_GET['alert'] == 'unbook_fail') {
                    echo <<<alert
                                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                                <strong> Server Down</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

            alert;
                }



                if ($_GET['alert'] == 'remove_failed') {
                    echo <<<alert
                                <div class="container alert alert-danger alert-dismissible text-center" role="alert">
                                <strong>Cannot deleted Server Down</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

            alert;
                }
            } else if (isset($_GET['success'])) {

                if ($_GET['success'] == 'removed') {
                    echo <<<alert
                                <div class="container alert alert-success alert-dismissible text-center" role="alert">
                                <strong>Registration Deleted </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

            alert;
                }
            }

            ?>
            <div>
                <div>
                    <div>
                        <div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container mt-4 p-0">
                <table class="table table-hover text-center">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th width="10%" scope="col" class="rounded-start">Sr. No.</th>
                            <th width="5%" scope="col">Name</th>
                            <th width="5%" scope="col">Gender</th>
                            <th width="10%" scope="col">DOB</th>
                            <th width="10%" scope="col">Address</th>
                            <th width="15%" scope="col">Hobbies</th>
                            <th width="15%" scope="col">Profilepic</th>
                            <th width="5%" scope="col">Delete</th>
                            <th width="5%" scope="col">Edit</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php

                        $query = "SELECT * FROM `form_details`";
                        $result = mysqli_query($con, $query);
                        $i = 1;


                        while ($fetch = mysqli_fetch_assoc($result)) {

                            echo <<<product
                                                <tr class="align-middle">
                                                <th scope="row">$i</th>
                                                <td>$fetch[Name]</td>
                                                <td>$fetch[Gender]</td>
                                                <td>$fetch[DOB]</td>
                                                <td>$fetch[Address]</td>
                                                <td>$fetch[Hobbies]</td>
                                                <td>$fetch[profilepic]</td> <td>
                                                <button onclick="confirm_rem($fetch[id])" class="btn btn-danger"><i class="bi bi-trash"></i></button> 
                                                <td><a href='./edit-user.php?id={$fetch['id']}' class='btn btn-pen'><i class='bi bi-pen'></i></a></td></td>
                                                </tr>
                                                product;
                            $i++;
                        }


                        ?>


                    </tbody>
                </table>

            </div>





            </tbody>

            </table>

        </div>



        <script>
            function confirm_rem(id) {
                if (confirm("Are you sure,you want to delete this USER?")) {
                    window.location.href = "crud.php?rem=" + id;
                }
            }
        </script>

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