<?php 
    session_start();
    $addtrain = false;
    $error = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include '../partials/_dbconnect.php';
        $train_id = $_POST['train_id'];
        $train_name = $_POST['train_name'];
        $src = $_POST['source'];
        $des = $_POST['destination'];
        $fare = $_POST['fare'];
        $seats = $_POST['seats'];
        $day1 = '';
        $day2 = '';
        $day3 = '';
        $day4 = '';
        $day5 = '';
        $day6 = '';
        $day7 = '';
        if(isset($_POST['day1']))
        {
            $day1 = $_POST['day1'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day1','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        if(isset($_POST['day2']))
        {
            $day2 = $_POST['day2'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day2','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        if(isset($_POST['day3']))
        {
            $day3 = $_POST['day3'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day3','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        if(isset($_POST['day4']))
        {
            $day4 = $_POST['day4'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day4','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        if(isset($_POST['day5']))
        {
            $day5 = $_POST['day5'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day5','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        if(isset($_POST['day6']))
        {
            $day6 = $_POST['day6'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day6','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        if(isset($_POST['day7']))
        {
            $day7 = $_POST['day7'];
            $sql2 = "INSERT INTO `seats`(`train_id`, `day`, `no_of_seats`) VALUES ('$train_id','$day7','$seats');";
            $result2 = mysqli_query($conn,$sql2);
        }
        $sql1 = "SELECT * FROM `train` WHERE train_id='$train_id' OR train_name='$train_name';";
        $result1=mysqli_query($conn,$sql1);
        $num=mysqli_num_rows($result1);
        if($num==0){
            $sql = "INSERT INTO `train`(`train_id`, `train_name`, `src`, `des`, `seats`, `fare`, `day`) 
                            VALUES ('$train_id','$train_name','$src','$des','$seats','$fare','$day1,$day2,$day3,$day4,$day5,$day6,$day7')";
            $result=mysqli_query($conn,$sql);
            if(isset($result)){
                $addtrain = "Train is inserted into the database";
            }
        }
        else{
            $error = "Train already exists with given train id/name in the database";
        }
        
    }
?>


<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome - <?php echo $_SESSION['username']?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        </style>
    </head>

    <body>
        <?php require '../partials/_nav_admin.php' ?>
        <?php include '../partials/_dbconnect.php'?>
        <?php
        if($addtrain)
        {
            echo
            '<div for="signup" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> '.$addtrain.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else if($error){
            echo
            '<div for="signup" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> '.$error.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        
        
        ?>
        <div class="container">
            <div class="mt-5 row d-flex justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body px-5 pb-3">
                            <h2 class="text-uppercase text-center mb-4">Add Train</h2>

                            <form action=add_train.php method="post">
                                <div class="form-group row">
                                    <label for="train_id" class="col-sm-3 col-form-label">Train ID</label>
                                    <div class="col-sm-9 p-0">
                                        <input style="border:0.5px solid;" required data-toggle="tooltip"
                                            title="Please ensure you fill this field" type="text"
                                            <?php if(isset($_GET['train_id'])) echo'value='.$_GET['train_id'].'';?>
                                            class="form-control" id="train_id" name="train_id"
                                            placeholder="Enter Train ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="train_name" class="col-sm-3 col-form-label">Train Name</label>
                                    <div class="col-sm-9 p-0">
                                        <input style="border:0.5px solid;" data-toggle="tooltip"
                                            title="Please ensure you fill this field" required type="text"
                                            class="form-control" id="train_name" name="train_name"
                                            placeholder="Enter Train Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="source" class="col-sm-3 col-form-label">Source</label>
                                    <div class="col-sm-9 p-0">
                                        <input style="border:0.5px solid;" data-toggle="tooltip"
                                            title="Please ensure you fill this field" required type="text"
                                            class="form-control" id="source" name="source" placeholder="Enter Source">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="destination" class="col-sm-3 col-form-label">Destination</label>
                                    <div class="col-sm-9 p-0">
                                        <input style="border:0.5px solid;" data-toggle="tooltip"
                                            title="Please ensure you fill this field" required type="text"
                                            class="form-control" id="destination" name="destination"
                                            placeholder="Enter Destination">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fare" class="col-sm-3 col-form-label">Fare</label>
                                    <div class="input-group col-sm-9 p-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rs.</span>
                                        </div>
                                        <input type="number" class="form-control" id="fare" name="fare">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="day" class="col-sm-3 col-form-label">Day</label>
                                    <div class="input-group p-0 col-sm-9 d-flex align-items-center">
                                        <input class="mr-1" type="checkbox" id="day1" name="day1" value="Mon">
                                        <label class="mr-2" for="day1">Mon</label>
                                        <input class="mr-1" type="checkbox" id="day2" name="day2" value="Tue">
                                        <label class="mr-2" for="day2">Tue</label>
                                        <input class="mr-1" type="checkbox" id="day3" name="day3" value="Wed">
                                        <label class="mr-2" for="day3">Wed</label>
                                        <input class="mr-1" type="checkbox" id="day4" name="day4" value="Thu">
                                        <label class="mr-2" for="day4">Thu</label>
                                        <input class="mr-1" type="checkbox" id="day5" name="day5" value="Fri">
                                        <label class="mr-2" for="day5">Fri</label>
                                        <input class="mr-1" type="checkbox" id="day6" name="day6" value="Sat">
                                        <label class="mr-2" for="day6">Sat</label>
                                        <input class="mr-1" type="checkbox" id="day7" name="day7" value="Sun">
                                        <label for="day7">Sun</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="age" class="col-sm-3 col-form-label">Number of
                                        seats</label>
                                    <div class="col-sm-9 p-0 d-flex align-items-center">
                                        <button style="font-weight:bold; font-size:15px; border:0.5px solid;"
                                            type="button" class="btn btn-light btn-sm" onclick="decrement()">-</button>
                                        <input required style="text-align:center; border:0.5px solid;" class="mx-2"
                                            name="seats" id="demoInput" type="number" value=1 min=1 max=999>
                                        <button style="font-weight:bold; font-size:15px; border:0.5px solid;"
                                            type="button" class="btn btn-light btn-sm" onclick="increment()">+</button>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark">Insert</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- bootstrap -->
        <script>
        function increment() {
            document.getElementById('demoInput').stepUp();
        }

        function decrement() {
            document.getElementById('demoInput').stepDown();
        }
        </script>
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