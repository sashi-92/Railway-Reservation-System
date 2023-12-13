    <?php
        include '../partials/_dbconnect.php';
        require_once '../dompdf/autoload.inc.php';
        $ticket_id = $_GET['ticket_id'];
        $sql = "select * from booking where ticket_id='$ticket_id';";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $train_id=$row['train_id'];
        $sql1="SELECT train_name FROM train WHERE train_id='$train_id';";
        $res1=mysqli_query($conn,$sql1);
        $row1=mysqli_fetch_assoc($res1);
        $sql2="SELECT fare FROM train WHERE train_id='$train_id';";
        $res2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($res2);
        $sql3 = "select passenger_name from booking where ticket_id='$ticket_id';";
        $res3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($res3);
        use Dompdf\Dompdf;
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled',TRUE);
        ob_start();
    ?>

    <html>

        <head>
            <h1 style="padding-top: 20pt;padding-left: 0pt;text-indent: 0pt;text-align:center;font-size:30px;">ISM
                Railways
            </h1>
        </head>

        <body>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h1 style="padding-top: 25pt;padding-left: 0pt;text-indent: 0pt;text-align: center;">Status of Payment
                <span class="s1">: </span><span style=" color: #008000;">Payment Successful</span>
            </h1>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <table style="border-collapse:collapse;margin-left:200pt;margin-right:175pt;" cellspacing="0">
                <tr style="height:25pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Ticket
                            ID :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['ticket_id']; ?> </p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Train
                            No :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['train_id']; ?> </p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Train
                            Name :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row1['train_name'];?> </p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Passenger Name :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['passenger_name']; ?></p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Source
                            :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['src']; ?> </p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Destination :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['des']; ?></p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Departure Date :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['departure_date']; ?></p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Number
                            of Tickets :</p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            <?php echo $row['no_of_tickets']; ?></p>
                    </td>
                </tr>
                <tr style="height:26pt">
                    <td
                        style="width:154pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s3" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Total Amount :
                        </p>
                    </td>
                    <td
                        style="width:281pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt">
                        <p class="s4" style="padding-top: 6pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                            Rs. <?php echo $row['no_of_tickets'] * $row2['fare']; ?>
                        </p>
                    </td>
                </tr>

            </table>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h2
                style="padding-top:20pt;padding-left: 36pt;padding-right: 36px;text-indent: 0pt;line-height: 106%;text-align: justify;">
                Note <span class="s6">:</span>
                <span style=" color: #F00;">[This receipt is subject to verification, keep your deduction proof of bank
                    with you. May have to produce the same if your receipt comes under scrutiny]</span>
            </h2>

        </body>

    </html>


    <style type="text/css">
* {
    margin: 0;
    padding: 0;
    text-indent: 0;
}

h1 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 12pt;
}

.s1 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 12pt;
}

.s3 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 11pt;
}

.s4 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 11pt;
}

.s5 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 11pt;
}

h2 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 11pt;
}

.s6 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 11pt;
}

p {
    color: #F00;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 11pt;
    margin: 0pt;
}

table,
tbody {
    vertical-align: top;
    overflow: visible;
}
    </style>

    <?php
        $html=ob_get_clean();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('ticket_'.$row3['passenger_name'].'.pdf',Array('Attachment'=>0));
            
    ?>