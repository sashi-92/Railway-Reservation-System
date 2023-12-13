<?php
    $showAlert = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include '../partials/_dbconnect.php';
        $username = $_POST["username"];
        $gender = $_POST["gender"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $pswd1 = $_POST["pswd1"];
        $pswd2 = $_POST["pswd2"];

        $sql1 = "SELECT * from users where username='$username' and role='1';";
        $result1 = mysqli_query($conn,$sql1);
        $num1 = mysqli_num_rows($result1);

        $sql2 = "SELECT * from users where email='$email' and role='1';";
        $result2 = mysqli_query($conn,$sql2);
        $num2 = mysqli_num_rows($result2);
        
        if($age<18)
        {
            $showError = "Age should be greater than 18!";
        }
        else if($num1!=0 && $num2!=0)
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
        else if(($pswd1 == $pswd2))
        {
            $hash = password_hash($pswd1, PASSWORD_DEFAULT);
            $sql2 = "INSERT INTO `users` (`username`, `gender`, `age`, `email`, `password` , `role`) VALUES ('$username', '$gender', '$age', '$email', '$hash' , '1');";
            $result2 = mysqli_query($conn,$sql2);
            if($result2)
            {
                $showAlert = true;
            }
        }
        else
        {
            $showError = "Passwords didn't match!";
        }
    }
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php require '../partials/_nav_admin.php' ?>

        <!-- Error popup -->
        <?php
        if($showAlert)
        {
            echo
            '<div for="signup" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> New Admin added.
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

        <!-- Signup Form -->
        <div class="container">
            <div class="mt-5 row d-flex justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body px-5 pb-3">
                            <h2 class="text-uppercase text-center mb-3">Add Admin</h2>

                            <form action=add_admin.php method="post">

                                <div class="form-outline mb-4">
                                    <input type="text" id="uname" maxlength="50" name="username"
                                        class="form-control form-control-lg" placeholder='Enter Username' required />
                                </div>
                                <div class="form-outline">
                                    <label for="gender" class="col-sm-3" style="font-size:18px;">Gender</label>
                                    <select class="col-sm-3" height=50px; name="gender" id="gender" required
                                        style="height:30px;">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="age" class="col-sm-3" style="font-size:18px;">Age</label>
                                    <input type="number" class="col-sm-3" id="age" name="age" placeholder=">17 yrs"
                                        required min="18" max="90">
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                                        placeholder='Enter Email' required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" minlength="8" id="pswd1" name="pswd1"
                                        class="form-control form-control-lg" placeholder='Enter Password' required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="pswd2" minlength="8" name="pswd2"
                                        class="form-control form-control-lg" placeholder='Re-Enter Password' required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark">Add</button>
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