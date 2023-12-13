<?php
    session_start();
    $showAlert = false;
    $showError = false;
    $username1 = $_SESSION['username'];
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include '../partials/_dbconnect.php';
        $username = $_POST["username"];
        $email = $_POST["email"];

        $sql1 = "SELECT * from users where username!='$username1' AND username='$username';";
        $result1 = mysqli_query($conn,$sql1);
        $num1 = mysqli_num_rows($result1);

        $sql2 = "SELECT * from users where username!='$username1' AND email='$email';";
        $result2 = mysqli_query($conn,$sql2);
        $num2 = mysqli_num_rows($result2);
        
        if($num1!=0 && $num2!=0)
        {
            $showError = "Username and Email already exists,try with any other Username and Email!";
        }
        else if($num1!=0)
        {
            $showError = "Username already exists,try with any other Username!";
        }
        else if($num2!=0)
        {
            $showError = "Email already exists,try with any other Email!";
        }
        else
        {
            $sql2 = "UPDATE `users` SET `username`='$username',`email`='$email' WHERE username='$username1';";
            $result2 = mysqli_query($conn,$sql2);
            if($result2)
            {
                $showAlert = "Profile Updated!";
                $_SESSION['username']=$username;
            }
        }
    }
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit your Details</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php require '../partials/_nav_user.php' ?>
        <!-- Error popup -->
        <?php
        if($showAlert)
        {
            echo
            '<div for="signup" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> '.$showAlert.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($showError)
        {
            echo
            '<div for="signup" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> '.$showError.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>

        <!-- Edit Form -->
        <div class="container">
            <div class="row d-flex justify-content-center" style="margin-top:100px;">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Edit your profile</h2>

                            <form method="post">

                                <div class="form-outline mb-4">
                                    <input type="text" id="uname" name="username" class="form-control form-control-lg"
                                        placeholder='Enter New/Old Username' required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                                        placeholder='Enter New/Old Email' required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
        </script>
    </body>

</html>