<?php
    session_start();   
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
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.4/dist/bootstrap-table.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    </head>

    <body>
        <?php require '../partials/_nav_admin.php' ?>
        <?php include '../partials/_dbconnect.php'?>

        <div class="container-fluid mt-4">
            <ul class="list-group">
                <div class="list-group-item active d-flex justify-content-between align-items-center" style="z-index:0;">
                    <span>Ticket booking history</span>
                    <span>
                        <form method="post" class="d-flex align-items-center">
                            <input type="text" name="search" id="search" placeholder="Search"
                                style="width:150px;padding-left:10px;border-radius:5px;" class="mx-2">
                            <button type="submit" class="btn btn-light">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </span>
                </div>
                <table id="my_table_1" data-toggle="table" data-sort-stable="true">
                    <thead>
                        <tr>
                            <th data-sortable="true">Ticket ID</th>
                            <th data-sortable="true">Train Name</th>
                            <th data-sortable="true">Passenger Name</th>
                            <th data-sortable="true">Source</th>
                            <th data-sortable="true">Destination</th>
                            <th data-sortable="true">Departure Date</th>
                            <th data-sortable="true">Number of Tickets</th>
                            <th data-sortable="false">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['username']))
                            {
                                $username = $_GET['username'];
                                $sql="SELECT * FROM booking WHERE username='$username';";
                                $res=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($res);
                                if($num!=0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $train_id=$row['train_id'];
                                        $sql1="SELECT train_name FROM train WHERE train_id='$train_id';";
                                        $res1=mysqli_query($conn,$sql1);
                                        $row1=mysqli_fetch_assoc($res1);
                                        echo '<tr>
                                            <td>'.$row['ticket_id'].'</td>
                                            <td>'.$row1['train_name'].'</td>
                                            <td>'.$row['passenger_name'].'</td>
                                            <td>'.$row['src'].'</td>
                                            <td>'.$row['des'].'</td>   
                                            <td>'.$row['departure_date'].'</td>                                     
                                            <td>'.$row['no_of_tickets'].'</td>
                                            <td>
                                                <div class="d-inline">
                                                <a href="functions/dlt_ticket.php?ticket_id='.$row['ticket_id'].'&train_id='.$row['train_id'].'&date='.$row['departure_date'].'&no_of_tickets='.$row['no_of_tickets'].'">
                                                <button name="delete" class="btn btn-primary btn-sm" >
                                                <i class="fa fa-trash"></i>
                                                </button></a></div>
                                            </td>
                                        </tr>';
                                    }
                                }
                            }
                            else if(isset($_POST['search']))
                            {
                                $search = $_POST['search'];
                                $sql="SELECT * FROM booking WHERE (train_id='$search' OR ticket_id='$search' OR src='$search' OR des='$search');";
                                $res=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($res);
                                if($num!=0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $train_id=$row['train_id'];
                                        $sql1="SELECT train_name FROM train WHERE train_id='$train_id';";
                                        $res1=mysqli_query($conn,$sql1);
                                        $row1=mysqli_fetch_assoc($res1);
                                        echo '<tr>
                                            <td>'.$row['ticket_id'].'</td>
                                            <td>'.$row1['train_name'].'</td>
                                            <td>'.$row['passenger_name'].'</td>
                                            <td>'.$row['src'].'</td>
                                            <td>'.$row['des'].'</td>   
                                            <td>'.$row['departure_date'].'</td>                                     
                                            <td>'.$row['no_of_tickets'].'</td>
                                            <td>
                                                <div class="d-inline">
                                                <a href="functions/dlt_ticket.php?ticket_id='.$row['ticket_id'].'&train_id='.$row['train_id'].'&date='.$row['departure_date'].'&no_of_tickets='.$row['no_of_tickets'].'">
                                                <button name="delete" class="btn btn-primary btn-sm" >
                                                <i class="fa fa-trash"></i>
                                                </button></a></div>
                                            </td>
                                        </tr>';
                                    }
                                }
                            }
                            else
                            {
                                $sql="SELECT * FROM booking;";
                                $res=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($res);
                                if($num!=0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $train_id=$row['train_id'];
                                        $sql1="SELECT train_name FROM train WHERE train_id='$train_id';";
                                        $res1=mysqli_query($conn,$sql1);
                                        $row1=mysqli_fetch_assoc($res1);
                                        echo '<tr>
                                            <td>'.$row['ticket_id'].'</td>
                                            <td>'.$row1['train_name'].'</td>
                                            <td>'.$row['passenger_name'].'</td>
                                            <td>'.$row['src'].'</td>
                                            <td>'.$row['des'].'</td>   
                                            <td>'.$row['departure_date'].'</td>                                     
                                            <td>'.$row['no_of_tickets'].'</td>
                                            <td>
                                                <div class="d-inline">
                                                <a href="functions/dlt_ticket.php?ticket_id='.$row['ticket_id'].'&train_id='.$row['train_id'].'&date='.$row['departure_date'].'&no_of_tickets='.$row['no_of_tickets'].'">
                                                <button name="delete" class="btn btn-primary btn-sm" >
                                                <i class="fa fa-trash"></i>
                                                </button></a></div>
                                            </td>
                                        </tr>';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>

            </ul>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/bootstrap-table@1.15.4/dist/bootstrap-table.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            console.log('ready');
            $('#my_table_1').find('input[type="date"]').change(function() {
                console.log(
                    'Table 1.Date was changed. Need to check if table is sorted by column C.If so - call the table sort.'
                );
            });
            $('#my_table_1').find('select').change(function() {
                console.log(
                    'Table 1.Selection was changed. Need to check if table is sorted by column B.If so - call the table sort.'
                );
            });
        });
        </script>
    </body>

</html>