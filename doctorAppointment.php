<?php include('server.php') ?>
<?php
$username = file_get_contents("form-save.txt");
$RESULT = " ";
$DATE = " ";
$dates = array();
$DOCTOR_IDENTIFICATION = 0;
$FIND_ID = "SELECT doctorID FROM doctor WHERE dUsername='$username'";
if (isset($con)) {
    $RESULT = mysqli_query($con,$FIND_ID);
}
if ($RESULT->num_rows > 0) {
    // output data of each row
    while($row = $RESULT->fetch_assoc()) {
        $CONTAINS_ID = $row["doctorID"];
        $DOCTOR_IDENTIFICATION = $CONTAINS_ID;
    }
}
            // Adding the appointments to their calender
$FIND_DATES = "SELECT date FROM patient_has_appointment, appointment WHERE patient_has_appointment.Appointment_appID = appID AND doctor_doctorID='$DOCTOR_IDENTIFICATION' ";

if (isset($con)) {
    $DATE = mysqli_query($con,$FIND_DATES);
}
if ($DATE->num_rows > 0) {
    // output data of each row
    while($row = $DATE->fetch_assoc()) {
        $current = $row["date"];
        $formattedDate = $current[3] . $current[4];
        array_push($dates, number_format($formattedDate));
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

        $ad = 11;

        $month_name = date("F", mktime(0, 0, 0, $ad, 10));
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


        $try = sizeof($dates)-1;
    for ($x = 1; $x <= 30; $x++) {


        if($try >= 0 AND $x == $dates[$try])
        {
            echo "<li><span class='active''>$x</span></li>";
            $try-=1;
        }
        else {
            echo "<li><span class='''>$x</span></li>";
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
</ul>
