<?php include('server.php') ?>
<?php
$username = file_get_contents("form-save.txt");
$RESULT = " ";
$DATE = " ";

$ID = 0;
$MONTH = " ";
$YA = NULL;
$ad = 0;
$PATIENT_BOOKED_APPOINTMENT = 0;
// Finds the ID
$ID = 0;
$FIND_ID = "SELECT patientID FROM patient WHERE pUsername='$username'";
if (isset($con)) {
    $RESULT = mysqli_query($con,$FIND_ID);
}
if ($RESULT->num_rows > 0) {
    // output data of each row
    while($row = $RESULT->fetch_assoc()) {
        $CONTAINS_ID = $row["patientID"];
        $ID = $CONTAINS_ID;
    }
}


$FIELD = "SELECT date FROM appointment WHERE Prescription_DIN='$ID'";
if (isset($con)) {
    $DATE = mysqli_query($con,$FIELD);
}
if ($DATE->num_rows > 0) {
    // output data of each row
    while($row = $DATE->fetch_assoc()) {
      $YA = $row["date"];
      $MONTH = $row["date"];

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="calendarstyle.css">
    <title>Your Appointments</title>
</head>

<div class="month">
    <ul>

        <li class="next">&#10095;</li>
        <?php

        // Get the date string

        if (empty($MONTH))
        {
            $ad = $MONTH[0] . $MONTH[1];
        }
        else
        {
            $ad = 11;
        }

        $month_name = date("F", mktime(0, 0, 0, $ad, 10));
        $username = $username = file_get_contents("form-save.txt");
        $RESULT = NULL;
        // Finds the ID
        $ID = 0;
        $FIND_ID = "SELECT patientID FROM patient WHERE pUsername='$username'";
        if (isset($con)) {
            $RESULT = mysqli_query($con,$FIND_ID);
        }
        if ($RESULT->num_rows > 0) {
            // output data of each row
            while($row = $RESULT->fetch_assoc()) {
                $CONTAINS_ID = $row["patientID"];
                $ID = $CONTAINS_ID;
            }
        }
        echo "<li>$month_name<br><span style='font-size:20px'>2020</span><li>";
        ?>
    </ul>
</div>

<ul class="weekdays">
    <li>Su</li>
    <li>Mo</li>
    <li>Tu</li>
    <li>We</li>
    <li>Th</li>
    <li>Fr</li>
    <li>Sa</li>
</ul>

<ul class="days">

    <?php


        if(empty($YA))
        {
            $PATIENT_BOOKED_APPOINTMENT = 0;
        }
        else
        {
            $PATIENT_BOOKED_APPOINTMENT = $YA[3] . $YA[4];
        }

    for ($x = 1; $x <= 30; $x++) {



        if ($x==10 OR $x==21 OR $x==27)
        {
          echo  "<li><span class='not''>$x</span></li>";
        }
        // Determining their appointment
      else  if ($x==$PATIENT_BOOKED_APPOINTMENT)
        {
            echo  "<li><span class='show''>$x</span></li>";
        }
      else if ($x < 9 OR $x==22)
      {
          echo  "<li><span class='active''>$x</span></li>";
      }
        else
        {
            echo "<li class='ali'>$x</li>";
        }
    }
    ?>



</ul>
<div class="legend header">
    <b>Legend</b>
</div>
<ul class="legend">
    <li><span class="booked"></span>Booked</li>
    <li><span class="available"></span> Available</li>
    <li><span class="unavailable"></span> Unavailable</li>
    <li><span class="yourA"></span> Your Appointment</li>
</ul>
