<?php include('server.php');

$RESULT = "NULL";
$DOCTOR_FULL_IDENTIFICATION = "NULL";

?>

<html>
<head>
    <title>DocPortal</title>
    <link rel="stylesheet" href="doctor-layout.css">

    <script>


        function imageClick2(url) {

            window.location = url;

        }

        function imageClick(url) { window.location = url;



        }
    </script>
</head>
    <body>
    <?php
    /**
     * Determine the doctors name and displays a welcome message
     */
    $DOCTOR_IDENTIFICATION =file_get_contents("form-save.txt");
    $DOCTOR = "SELECT fName, mInitial, lName FROM doctor WHERE dUsername='$DOCTOR_IDENTIFICATION'";
    if (isset($con)) {
        $RESULT = mysqli_query($con,$DOCTOR);
    }
    if ($RESULT->num_rows > 0) {
        // output data of each row
        while($row = $RESULT->fetch_assoc()) {
            $FULL_NAME = $row["fName"] . " " . $row["mInitial"]."." . " " . $row["lName"]  ;
            $DOCTOR_FULL_IDENTIFICATION = $FULL_NAME;
        }
    }

    echo "<h1 class='greeting'>Welcome Dr. $DOCTOR_FULL_IDENTIFICATION</h1>";
    ?>

    <div class="pate">
        <img src="pill_img/pencil.png" class="float" title="Write Prescriptions"id="backHome" width="180" height="180"   alt="Image of pill/Floating" onclick="imageClick('writePrescriptions.php')">


        <img src="pill_img/documents.png" class="float" title="Write Results" width="180" height="180" id="backHome"  alt="Image of pill/Floating" onclick="imageClick('writeResults.php')">



        <img src="pill_img/search-engine.png" class="float" title="View Messages" width="180" height="180"  id="backHome"  alt="Image of pill/Floating" onclick="imageClick('doctorEmail.php')">

        <img src="pill_img/projector.png" class="float" title="Clock Out" width="180" height="180"  id="backHome"  alt="Image of pill/Floating" onclick="imageClick('SignOut.php')">
    </div>
    <?php

    ?>
    <form action="doctorAppointment.php" method="none">
    <input type="submit" class="button" name="Doctor-Appointments" value="View Appointments">
    </form>
    </body>
</html>