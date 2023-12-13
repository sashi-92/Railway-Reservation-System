<?php
    session_start();
    $showAlert = false;
    $showError = false;
    $username1 = $_SESSION['username'];
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include '../partials/_dbconnect.php';
        $old_pswd = $_POST["opswd"];
        $new_pswd1 = $_POST["npswd1"];
        $new_pswd2 = $_POST["npswd2"];
        $sql1 = "SELECT * FROM users WHERE username='$username1';";
        $res1 = mysqli_query($conn,$sql1);
        $num = mysqli_num_rows($res1);
        if($num==1)
        {
            $row = mysqli_fetch_assoc($res1);
            if(password_verify($old_pswd,$row['password']))
            {   
                if($new_pswd1==$new_pswd2)
                {
                    $hash = password_hash($new_pswd1, PASSWORD_DEFAULT);
                    $sql2 = "UPDATE users SET `password`='$hash' where username='$username1'";
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2)
                    {
                        $showAlert = "Password Updated!";
                    }
                }
                else
                {
                    $showError = "New Passwords didn't match!";
                }
            }
            else
            {
                $showError = "Old Password didn't match!";
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
                            <h2 class="text-uppercase text-center mb-5">Change Password</h2>

                            <form method="post">

                                <div class="form-outline mb-4">
                                    <input type="password" id="uname" name="opswd" class="form-control form-control-lg"
                                        placeholder='Enter Old Password' required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="npswd1" name="npswd1" class="form-control form-control-lg"
                                        placeholder='Enter New Password' required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="npswd2" name="npswd2" class="form-control form-control-lg"
                                        placeholder='Re-Enter New Password' required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark">Change</button>
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