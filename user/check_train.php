<?php
 session_start();
 $username=$_SESSION["username"];
 ?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome <?php echo $username; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php require '../partials/_nav_user.php' ?>
        <?php include '../partials/_dbconnect.php'?>
        <?php

            echo'
            <div style="display:grid; place-items:center;">
                <div class="container card col-sm-9 mt-5">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Trains Between Stations</h5>
                        <div class="train-form">
                            <div class="container">
                                <form method="post">
                                    <div class="input-group p-1 d-flex justify-content-center align-items-center">
                                        <div class="form-group d-inline ml-4">
                                            <input required type="text" class="form-control" id="from" name="from" placeholder="Enter Source">
                                        </div>
                                        <div class="form-group d-inline ml-4">
                                            <input type="button" id="switch" onclick="switchText()" value=&#8651>
                                        </div>
                                        <div class="form-group d-inline ml-4">
                                            <input required type="text" class="form-control" id="to" name="to" placeholder="Enter Destination">
                                        </div>
                                        <div class="form-group d-inline ml-4">
                                            <input required type="date" class="form-control" id="date" name="date">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-dark" onclick="submitform(this.form)">Check Trains</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card w-50 my-4">
                    <div class="card-body" style="display:grid; place-items:center;">
                        <h5 class="card-title text-center mb-4">Enter Train Name or No.</h5>
                        <div class="train-form">
                            <div class="container mt-0">
                                <form method="post">
                                    <div>
                                        <input style="width: 250px;" required type="text" class="form-control" id="name" name="name" placeholder="Enter Train Name or No.">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-dark" onclick="submitform(this.form)">Check Trains</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                include '../partials/_dbconnect.php';

                $from = $_POST["from"];
                $to = $_POST["to"];
                $date = $_POST["date"];
                $name = $_POST["name"];



                if(isset($_POST["from"]))
                {
                    $sql = "SELECT * from train where src='$from' AND des='$to';";
                    $result = mysqli_query($conn,$sql);
                    $num = mysqli_num_rows($result);
                    if($num==0)
                    {
                        echo '<div class="container d-flex align-items-center flex-column ">
                                <img src="../images/no train.jpg" alt="" style="height:100px;width:100px;"><br>
                                <p> No trains are available from '.$from.' to '.$to.' on '.$date.'.</p>
                            </div>
                            <style>
                                p{
                                    font-size:20px;
                                }
                            </style>';
                    }
                    else
                    {
                        echo '<div class="container">
                            <div class="row">';
                        while($row=mysqli_fetch_assoc($result)){
                            echo '<div class="d-flex col-md-4 px-0 my-4 cards">
                                    <div class="card mx-3">
                                        <div class="card-body">
                                            &nbsp&nbsp<span class="fa fa-train" style="font-size:24px"></span>&nbsp
                                            <h5 style="display:inline;" class="card-title">&nbsp&nbsp'.$row['train_id'].'&nbsp&nbsp '.$row['train_name'].'</h5>
                                            <br><br>
                                            <h6 class="card-subtitle mb-2 text-muted">Availability - '.$row['day'].'</h6>
                                            <span class="card-text text-left" style="margin-bottom:0.5rem;">'.$row['src'].' &#8651 '.$row['des'].' &nbsp&nbsp</span>
                                            <span>Ticket Price - &#8377 '.$row['fare'].'</span>
                                            <br><span class="pt-2">Seats Available - '.$row['seats'].'</span>
                                            <br><div class="px-2" style="text-align:right;">
                                            <a class="btn btn-primary" href="bk_tkt.php?train_id='.$row['train_id'].'" class="card-link">Book Ticket</a></div>
                                        </div>
                                    </div>
                                </div>';
                        }

                    }
                }
                else if(isset($_POST["name"]))
                {
                    $sql = "SELECT * from train where train_name='$name' OR train_id='$name';";
                    $result = mysqli_query($conn,$sql);
                    $num = mysqli_num_rows($result);
                    if($num==0)
                    {
                        echo '<div class="container d-flex align-items-center flex-column ">
                                <img src="../images/no train.jpg" alt="" style="height:100px;width:100px;"><br>
                                <p> No trains are available with Train Name or Id - '.$name.'.</p>
                            </div>
                            <style>
                                p{
                                    font-size:20px;
                                }
                            </style>';
                    }
                    else
                    {
                        echo '<div class="container">
                            <div class="row">';
                        while($row=mysqli_fetch_assoc($result)){
                            echo '<div class="d-flex col-md-4 px-0 my-4 cards">
                                    <div class="card mx-3">
                                        <div class="card-body">
                                            &nbsp&nbsp<span class="fa fa-train" style="font-size:24px"></span>&nbsp
                                            <h5 style="display:inline;" class="card-title">&nbsp&nbsp'.$row['train_id'].'&nbsp&nbsp '.$row['train_name'].'</h5>
                                            <br><br>
                                            <h6 class="card-subtitle mb-2 text-muted">Availability - '.$row['day'].'</h6>
                                            <span class="card-text text-left" style="margin-bottom:0.5rem;">'.$row['src'].' &#8651 '.$row['des'].' &nbsp&nbsp</span>
                                            <span>Ticket Price - &#8377 '.$row['fare'].'</span>
                                            <br><span class="pt-2">Seats Available - '.$row['seats'].'</span>
                                            <br><div class="px-2" style="text-align:right;">
                                            <a class="btn btn-primary" href="bk_tkt.php?train_id='.$row['train_id'].'" class="card-link">Book Ticket</a></div>
                                        </div>
                                    </div>
                                </div>';
                        }

                    }
                }
            }
        ?>

        <!-- bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
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
        <script>
        function switchText() {
            var obj1 = document.getElementById('from').value;
            var obj2 = document.getElementById('to').value;

            var temp = obj1;
            obj1 = obj2;
            obj2 = temp;

            // Save the swapped values to the input element.
            document.getElementById('from').value = obj1;
            document.getElementById('to').value = obj2;
        }
        </script>
    </body>

</html>
