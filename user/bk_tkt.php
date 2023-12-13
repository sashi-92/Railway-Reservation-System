<?php
    session_start();
    $username1=$_SESSION["username"];
    $checktickets = false;
    $checktrainid = false;
    $checkdate = false;
    $ticketbooked = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include '../partials/_dbconnect.php';
        // Collecting Form Data
        $username = $_SESSION['username'];
        $passenger_name = $_POST["passenger_name"];
        $trainid = $_POST["train_id"];
        $date = $_POST["date"];
        $date1 = strtotime($date);
        $day = date("D",$date1);
        $sex = $_POST["gender"];
        $no_of_tickets = $_POST["no_of_tickets"];

        $sql1 = "SELECT * FROM train WHERE train_id='$trainid';";
        $res1 = mysqli_query($conn,$sql1);
        $num1 = mysqli_num_rows($res1);

        if($num1!=0)
        {
            $sql2 = "SELECT * FROM `train` WHERE train_id='$trainid' AND FIND_IN_SET('$day',day);";
            $res2 = mysqli_query($conn,$sql2);
            $num2 = mysqli_num_rows($res2);

            if($num2!=0)
            {
                $sql3 = "SELECT * FROM `seats` WHERE `train_id`='$trainid' AND `date`='$date';";
                $res3 = mysqli_query($conn,$sql3);
                $num3 = mysqli_num_rows($res3);
                $row2 = mysqli_fetch_assoc($res2);
                $seats = $row2['seats'];
                if($num3!=0)
                {
                    $row3 = mysqli_fetch_assoc($res3);
                    if($no_of_tickets > $seats-$row3['ticket_booked'])
                    {
                        $checktickets="Sorry, only ".$seats-$row3['ticket_booked']." seats are available in the train ".$trainid."";
                    }
                    else
                    {
                        $sql5 = "UPDATE `seats` SET ticket_booked=ticket_booked+$no_of_tickets WHERE `train_id`='$trainid' AND `date`='$date';";
                        $res5 = mysqli_query($conn,$sql5);
                        if(isset($res5))
                        {
                            $time = time();
                            $ticketid = $time;
                            $sql6 = "SELECT src,des FROM train WHERE train_id='$trainid';";
                            $res6 = mysqli_query($conn,$sql6);
                            $num6 = mysqli_fetch_assoc($res6);
                            $src = $num6['src'];
                            $desc = $num6['des'];
                            $ticketbooked = "Your ticket is booked for the train ".$trainid." on ".$date."";
                            $sql7 = "INSERT INTO booking VALUES ('$ticketid', '$trainid', '$username', '$src', '$desc', '$date', '$passenger_name', '$no_of_tickets', '$sex');";
                            $res7 = mysqli_query($conn,$sql7);
                        }
                    }
                }
                else
                {
                    if($no_of_tickets > $seats)
                    {
                        $checktickets="Sorry, only ".$seats." seats are available in the train ".$trainid."";
                    }
                    else
                    {
                        $sql4 = "INSERT INTO `seats`(`train_id`, `date`, `ticket_booked`) VALUES ('$trainid','$date','$no_of_tickets')";
                        $res4 = mysqli_query($conn,$sql4);
                        if(isset($res4))
                        {
                            $time = time();
                            $ticketid = $time;
                            $sql6 = "SELECT src,des FROM train WHERE train_id='$trainid';";
                            $res6 = mysqli_query($conn,$sql6);
                            $num6 = mysqli_fetch_assoc($res6);
                            $src = $num6['src'];
                            $desc = $num6['des'];
                            $sql7 = "INSERT INTO booking VALUES ('$ticketid', '$trainid', '$username', '$src', '$desc', '$date', '$passenger_name', '$no_of_tickets', '$sex');";
                            $res7 = mysqli_query($conn,$sql7);
                            $ticketbooked = "Your ticket is booked for the train ".$trainid." on ".$date."";
                        }
                    }
                }
            }
            else
            {
                $checkdate="Train ID ".$trainid." doesn't exist on the day selected";
            }

        }
        else
        {
            $checktrainid="Invalid Train ID";
        }
    }
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome <?php echo $username1; ?></title>
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
        <?php require '../partials/_nav_user.php' ?>
        <?php include '../partials/_dbconnect.php'?>

        <?php
            if($checktrainid)
            {
                echo
                '<div for="signup" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> '.$checktrainid.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else if($checkdate)
            {
                echo
                '<div for="signup" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> '.$checkdate.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else if($checktickets)
            {
                echo
                '<div for="signup" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> '.$checktickets.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else if($ticketbooked)
            {
                echo
                '<div for="signup" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> '.$ticketbooked.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        ?>

        <div class="container h-100">
            <div class="mt-5 row d-flex justify-content-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Ticket Booking Form</h2>

                            <form action=bk_tkt.php method="post">
                                <div class="form-group row">
                                    <label for="train_id" class="col-sm-3 col-form-label">Train ID</label>
                                    <div class="col-sm-9">
                                        <input style="border:0.5px solid;" required data-toggle="tooltip"
                                            title="Please ensure you fill this field" type="text"
                                            <?php if(isset($_GET['train_id'])) echo'value='.$_GET['train_id'].'';?>
                                            class="form-control" id="train_id" name="train_id"
                                            placeholder="Enter Train ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 col-form-label">Select Date</label>
                                    <div class="col-sm-9">
                                        <input style="border:0.5px solid;" data-toggle="tooltip"
                                            title="Please ensure you fill this field" required type="date"
                                            class="form-control" id="date" name="date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="passenger_name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input style="border:0.5px solid;" data-toggle="tooltip"
                                            title="Please ensure you fill this field" required type="text"
                                            class="form-control" id="passenger_name" name="passenger_name"
                                            placeholder="Enter Passenger Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 mr-3 col-form-label">Gender</label>
                                    <select class="col-sm-3" height=50px; name="gender" id="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="age" class="col-sm-3 col-form-label">Number of
                                        tickets</label>
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <button style="font-weight:bold; font-size:15px; border:0.5px solid;"
                                            type="button" class="btn btn-light btn-sm" onclick="decrement()">-</button>
                                        <input required style="text-align:center; border:0.5px solid;" class="mx-2"
                                            name="no_of_tickets" id="demoInput" type="number" value=1 min=1 max=999>
                                        <button style="font-weight:bold; font-size:15px; border:0.5px solid;"
                                            type="button" class="btn btn-light btn-sm" onclick="increment()">+</button>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark">Confirm Booking</button>
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
