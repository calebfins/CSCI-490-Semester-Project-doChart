<?php include('server.php');?>
<?php
$RESULT = " ";
$RESULT2 = " ";
$DOCTOR_ID = 0;
$ID = " ";
$PN = " ";
$DOCTOR_IDENTIFICATION = file_get_contents("form-save.txt");

/**
 *  Get the corresponding doctor ID number
 */
$query = "SELECT doctorID FROM doctor WHERE dUsername='$DOCTOR_IDENTIFICATION'";
if (isset($con)) {
    $RESULT = mysqli_query($con,$query);
}
if ($RESULT->num_rows > 0) {
    // output data of each row
    while($row = $RESULT->fetch_assoc()) {
        $ID = $row["doctorID"]  ;
        $DOCTOR_ID = $ID;
    }
}

?>

<DOCTYPE>
    <head>
        <title>DocMail</title>
        <style>
            .bold
            {
                font-weight: bolder;
            }
        </style>
        <link rel="stylesheet" href="email.css">

        <script>


            function imageClick2(url) {

                window.location = url;

            }

            function imageClick(url) { window.location = url;



            }
        </script>
    </head>
    <body>
    <div class="header">
        <p>The official email of <span class='special-word'>DoChart</span></p>
        <img src="pill_img/message.png" alt="logo" onclick="imageClick('doctorPortal.php')"/>
        <h1>DoChart Mail</h1>
          </div>

    <?php
    /***
     *  This is where I will possibly create a li that corresponds to the emails send
     *  To a specific doctor and it will display..
     * CSS - thinking of a light yellow background or soft light red background!!!!
     */
    ?>
    <div class="mailing-body">
        <?php
        echo "<div class='head'></div>";
        $query = "SELECT messageResponse, Patient_patientID FROM contactDoctor WHERE Doctor_doctorID='$DOCTOR_ID'";
        if (isset($con)) {
            $RESULT = mysqli_query($con,$query);
        }
        if ($RESULT->num_rows > 0)
        {
            // output data of each row
            while($row = $RESULT->fetch_assoc())
            {
                $ID = $row["messageResponse"];
                $patientID = $row["Patient_patientID"];
                $NAME = "SELECT fName, lName FROM patient WHERE patientID='$patientID'";
                if (isset($con)) {
                    $RESULT2 = mysqli_query($con,$NAME);
                }
        if ($RESULT2->num_rows > 0)
        {
            // output data of each row
            while ($row = $RESULT2->fetch_assoc())
            {
                $PN = $row["fName"] . " " . $row["lName"] ;
            }
        }//if
                echo "<div class='head' xmlns=\"http://www.w3.org/1999/html\"><img src='pill_img/profile-user.png'><li class='borderList'>&nbsp     &nbsp <span class='bold'>$PN</span> &nbsp           &nbsp $ID</li></div>";
            }



        }
        ?>

    </div>
    </body>
</DOCTYPE>
