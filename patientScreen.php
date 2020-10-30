<?php include('server.php'); ?>



<!DOCTYPE html>
<html lang="en">
<?php
$IDENTIFICATION = $_GET['username'];
$USER_IDENTIFICATION = "NULL";
$RESULT ="";
?>



<head>
    <title>Patient Portal</title>
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


    function imageClick2(url) {

        window.location = url;

    }

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

$alreadyLogged = file_get_contents("form-save.txt");

if ($USER_IDENTIFICATION == "NULL")
{
    if ($alreadyLogged != NULL)
    {
        $USER_IDENTIFICATION = $alreadyLogged;
    }
    else{
        header('location: notLogged.php');
        exit();
    }

}
echo "<p class='greeting'>Welcome $USER_IDENTIFICATION</p>";
$username = file_get_contents("form-save.txt");
// echo $username;
?>
<body>
<div class="pate">

    <img src="pill_img/calendar.png" class="" width="180" height="175"  title="View Appointments" id="backHome"  alt="Image of pill/Floating" onclick="imageClick('viewAppointment.php')">

    <img src="pill_img/doctor.png" class="float" title="Contact Doctor" id="backHome" width="180" height="180"  alt="Image of pill/Floating" onclick="imageClick('contact.php')">
<img src="pill_img/pills.png" class="float" title="View pills" id="backHome" width="180" height="180"   alt="Image of pill/Floating" onclick="imageClick('pill.php')">


    <img src="pill_img/health-report.png" class="float" title="Health History" id="backHome" width="205" height="205"   alt="Image of pill/Floating" onclick="imageClick('healthHistory.php')">


    <img src="pill_img/results.png" class="float" title="View Results" width="180" height="180" id="backHome"  alt="Image of pill/Floating" onclick="imageClick('patientResults.php')">



    <img src="pill_img/paper.png" class="float" title="Book Appointment" width="180" height="180"  id="backHome"  alt="Image of pill/Floating" onclick="imageClick('bookAppointment.php')">

    <img src="pill_img/logout.png" class="float" name="Logout" title="Logout" id="backHome" width="170" height="170"  alt="Image of pill/Floating" onclick="imageClick('signOut.php')">


</div>



</body>
</html>