<?php
    include '../partials/_dbconnect.php';
    session_start();
    $username1 = $_SESSION['username'];
    $query="SELECT * FROM users WHERE username='$username1'";
    $res=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($res);
    $gender=$row['gender'];
    $email=$row['email'];
    $age=$row['age'];
   
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        .profile label {
            font-weight: 600;
        }

        .profile p {
            font-weight: 600;
            color: #0062cc;
        }
        </style>
    </head>

    <body>
        <?php require '../partials/_nav_user.php' ?>

        <div class="container">
            <div class="row d-flex justify-content-center" style="margin-top:100px;">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">USER INFORMATION</h2>

                            <div class="profile">
                                <div class="row">
                                    <div class="col-lg-5" style="padding-left: 40px;">
                                        <label>User Name</label>
                                    </div>
                                    <div class="col-lg-7" style="padding-left: 40px;">
                                        <p><?php echo $username1;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5" style="padding-left: 40px;">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-lg-7" style="padding-left: 40px;">
                                        <p><?php echo $email;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5" style="padding-left: 40px;">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-lg-7" style="padding-left: 40px;">
                                        <p><?php echo $gender;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5" style="padding-left: 40px;">
                                        <label>Age</label>
                                    </div>
                                    <div class="col-lg-7" style="padding-left: 40px;">
                                        <p><?php echo $age;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5" style="padding-left: 40px;">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-lg-7" style="padding-left: 40px;">
                                        <p>123 456 7890</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/ulg/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
        </script>
    </body>

</html>