<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php
$IDENTIFICATION = $_GET['username'];
$USER_IDENTIFICATION = "NULL";
$RESULT ="";
?>
<head>
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="mystyle.css">
    <style>

        body
        {
            background-image: url('pill_img/portal.png');

        }
    </style>
</head>

<script>
    function imageClick(url) { window.location = url;
    }
</script>

<?php

$NAME = "SELECT fName, lName FROM patient WHERE pUsername='$IDENTIFICATION'";
if (isset($con)) {
    $RESULT = mysqli_query($con,$NAME);
}
if ($RESULT->num_rows > 0) {
    // output data of each row
    while($row = $RESULT->fetch_assoc()) {
        $FULL_NAME = $row["fName"] . " " . $row["lName"]  ;
        $USER_IDENTIFICATION = $FULL_NAME;
    }
}

echo "<p class='greeting'>Welcome $USER_IDENTIFICATION</p>"

?>

<div class="pate">

    <img src="pill_img/calendar.png" class="" width="180" height="175"  title="View Appointments" id="backHome"  alt="Image of pill/Floating" onclick="imageClick('viewappointment.php')">

    <img src="pill_img/doctor.png" class="float" title="Contact Doctor" id="backHome" width="180" height="180"  alt="Image of pill/Floating" onclick="imageClick('schedule.php')">
<img src="pill_img/pills.png" class="float" title="View pills" id="backHome" width="180" height="180"   alt="Image of pill/Floating" onclick="imageClick('pill.php')">


    <img src="pill_img/health-report.png" class="float" title="Health History" id="backHome" width="205" height="205"   alt="Image of pill/Floating" onclick="imageClick('schedule.php')">


    <img src="pill_img/results.png" class="float" title="View Results" width="180" height="180" id="backHome"  alt="Image of pill/Floating" onclick="imageClick('schedule.php')">



    <img src="pill_img/paper.png" class="float" title="Book Appointment" width="180" height="180"  id="backHome"  alt="Image of pill/Floating" onclick="imageClick('schedule.php')">
    <img src="pill_img/logout.png" class="float" title="Logout" id="backHome" width="170" height="170"  alt="Image of pill/Floating" onclick="imageClick('login.php')">
</div>



</html>