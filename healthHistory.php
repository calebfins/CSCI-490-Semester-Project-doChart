<?php include('server.php');

// Contains the patients user name
$username = file_get_contents("form-save.txt");
$FULL_NAME = "NULL";
$RESULT = "";
$USER_IDENTIFICATION = " ";
$NAME = "SELECT fName, lName FROM patient WHERE pUsername='$username'";
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



echo "<h1>This information is intended for the patient <mark>$USER_IDENTIFICATION</mark>, and if you are viewing the screen <mark>and NOT $USER_IDENTIFICATION, Exit immediately! NOT doing so will</mark> result in a <mark>criminal investigation.</mark> Viewing others personal information at <mark>DoChart is a violation of HIPAA and patient conduct!</mark></h1>";


?>

<DOCTYPE>

    <head>
        <link rel="stylesheet" href="format.css">
        <style>
        body {
        background-image: url('pill_img/trial.jpg');
        }
        </style>
    </head>
    <body>

<div class="narrow">
    <form class="" action="healthHistory.php" method="POST">
        <p>Clicking the button you verify that you are the the owner of this account</p>
        <input type="Submit" id="display_health" value="Display Health History" name="display_health">
    </form>
</div>

    </body>
</DOCTYPE>
<?php
/***
 *  This involves displaying the patients data - health records
 */
if (isset($_POST['display_health']))
{
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
    // Find health results
    $HEALTH = "NULL";
    $HEALTH_REPORT = "SELECT Patient_patientID, responseHealth FROM health WHERE Patient_patientID=$ID";
    if (isset($con)) {
        $RESULT = mysqli_query($con,$HEALTH_REPORT);
    }
    if ($RESULT->num_rows > 0) {
        // output data of each row
        while($row = $RESULT->fetch_assoc()) {
            $REPORT = "<div class='results'><li class='borderList'>[".$row["Patient_patientID"]."]" . " - ". $row["responseHealth"] . "</li></div>";
            $HEALTH = $REPORT . "\n";
            echo $HEALTH . "\n";
        }
    }
    else
    {
        echo "<div><li class='borderList'>No results at this moment, check back later.</li></div><br>";
    }
    echo "<mark>Reports for $USER_IDENTIFICATION on " . date("m/d/y") . " at " . date("h:i:sa"). "</mark>";
}//
