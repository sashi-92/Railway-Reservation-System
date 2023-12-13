<?php
    // Redirecting to Login Page if not logged in
    session_start();
    $username=$_SESSION["username"];
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location : ../index/login_admin.php");
        exit;
    }
?>

<style>
    .cards:hover {
        transform: scale(1.1);
    }

    .cards {
        transition: 0.5s;

    }

    body {
        background-color: #e3f2fd;
    }
    .content{
        padding-top: 65px
    }
    .train-gif{
        width: 100%;
    }
    .content{
        background-image: url("https://media.giphy.com/media/YMFaVun63LiWR6Ns6N/giphy.gif");
        background-repeat: no-repeat;
        background-size: cover;
        color:white;
    }

    .heading
    {
        color:white;
    }
</style>

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
        <?php require '../partials/_nav_admin.php' ?>
        <?php include '../partials/_dbconnect.php'?>

        <!-- Slider Starts here
        <div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../images/img3.jpeg" class="d-block w-100">
                    </div>
                    <div class="carousel-item active">
                        <img src="../images/img3.jpeg" class="d-block w-100">
                    </div>
                    <div class="carousel-item active">
                        <img src="../images/img3.jpeg" class="d-block w-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div> -->

        <div class="content">
                <h2 class="mt-4 mx-4 heading text-center">Trains Running</h2>

        <!-- Trains Running Cards -->
        <div class="container">
            <div class="row">
                <?php
            $day = date("D");
            $sql = "SELECT * from train";
            $res = mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($res)){
                echo '<div class="col-md-4 px-0 my-4 cards">
                    <div class="card frosted-card mx-3" style="background: rgba( 0, 0, 0, 0.55 );
                    box-shadow: 0 8px 32px 0 rgba( 31, 38, 13, 0.37 );
                    backdrop-filter: blur( 0px );
                    -webkit-backdrop-filter: blur( 0px );
                    border-radius: 10px;
                    border: 1px solid rgba( 255, 255, 255, 0.18 );">
                        <div class="card-body">
                            &nbsp&nbsp<span class="fa fa-train" style="font-size:24px"></span>&nbsp
                            <h5 style="display:inline;" class="card-title">&nbsp&nbsp'.$row['train_id'].'&nbsp- '.$row['train_name'].'</h5>
                            <br><br>
                            <h6 class="card-subtitle mb-2">Availability - '.$row['day'].'</h6>
                            <p class="card-text text-left" style="margin-bottom:0.5rem;">'.$row['src'].' -> '.$row['des'].'</p><span>Ticket Price - &#8377 '.$row['fare'].'</span>
                            <br><div class="px-2" style="text-align:right;"><a class="btn btn-primary" href="login_user.php" class="card-link">Book Ticket</a></div>
                        </div>
                    </div>
                </div>';
            }
        ?>

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
