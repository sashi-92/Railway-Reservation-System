<?php
    $login = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include '../partials/_dbconnect.php';
        $username = $_POST["username"];
        $pswd = $_POST["pswd"];

        // Checking whether user exists in the database
        $sql = "SELECT * from users where username='$username' AND role='0'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if(password_verify($pswd,$row['password']))
                {   
                    echo 'Hurray';
                    $login = true;
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$username;
                    header("location: ../user/welcome_user.php");
                }
                else
                {
                    $showError = "Invalid Credentials!";
                }
            }
        }
        else
        {
            $showError = "Invalid Credentials!";
        }
    }
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php require '../partials/_nav_guest.php' ?>
        <!-- Error popup -->
        <?php
        if($login)
        {
            echo
            '<div for="signup" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in!!
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

        <!-- Login Form -->
        <div class="container">
            <div style="margin-top:100px;" class="row d-flex justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Sign-In as User</h2>

                            <form action=login_user.php method="post">

                                <div class="form-outline mb-4">
                                    <input type="text" id="uname" name="username" class="form-control form-control-lg"
                                        placeholder='Enter Username' required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="pswd" name="pswd" class="form-control form-control-lg"
                                        placeholder='Enter Password' required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark">Login</button>
                                </div>

                                <p class="text-center text-muted mt-3 mb-0">Do not have an account? <a href="signup.php"
                                        class="fw-bold text-body"><u>SignUp</u></a>&nbsphere</p>

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