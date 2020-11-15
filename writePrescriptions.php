<?php
include('server.php');
$DOCTOR_FULL_IDENTIFICATION = " ";
?>
<html xmlns="http://www.w3.org/1999/html">

    <head>
        <style>
            body{
                background-color:  #ffcccc;
            }
            .counterDiv
            {
                width: 100%;
                height:150px;
                margin-top: 25px;
            }
            .counterDiv p{
                margin-left: 125px;
            }
            .counterDiv label
            {
                margin-top: 25px;
            }
            .counterDiv img
            {
                float: left;
                margin-top: 202px;
            }
            .counterDiv div
            {
                border-radius: 25px;
                margin-top: 210px;
                float: right;
                width: 500px;
                height: 450px;
                border: 3px solid darkred;
                margin-right: 20px;
                background-color: wheat;
            }
            .yellow
            {
                background-color: yellow;
            }
            .red
            {
                background-color: darkred;
                width:370px;
                height:50px;
                border-bottom-left-radius:50%;
                border-bottom-right-radius:50%;
                float: left;
            }
            .green
            {
                background-color: limegreen;
            }
            .blue
            {
                background-color: cornflowerblue;
                margin-top: 50px;
            }
            .red h1
            {
                margin-left: 100px;
                margin-top: 0px;
                color: wheat;
            }
            a
            {
                text-decoration: none;
                color: wheat;
            }
            img
            {
                margin-top: 132px;
            }
            form
            {
                background-color: wheat;
                margin-top: 010px;
                margin-left: 25px;
                width: 400px;
                height: 100px;
            }
            br
            {
                border-radius: 25px;
            }
        label
        {
        font-size: 20px;
            font-weight: inherit;
            font-family: "Harlow Solid Italic";
            margin-bottom: 50px;
            margin-top: 25px;

        }
            label[id=DIN]
            {
                font-weight: inherit;
            }
        input
        {
            font-size: medium;
            margin-left: 5px;
            height: 35px;
            width: 161px;
            text-align: center;
            border-color: darkred;
            border-radius: 22px;
            box-shadow: none;
            outline: none;
           border-bottom-color: darkred;
            border-bottom-width: thick;
        }
            input[type=Submit]
            {
                margin-left: 120px;
                border-radius: 22px;

                border-bottom-color: darkred;
                border-bottom-width: thick;

            }
            .error
            {

                width: 50%;
                color: #D8000C;
                background-color: #FFD2D2;
                border-color: #D8000C;
                height: 20px;
                text-align: center;
                border-radius: 5px;
            }
        </style>
        <script>
            function imageClick(url) { window.location = url;
            }
        </script>
    </head>

    <body>
    <div class="red">
        <?php
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

        echo "<h1 >$DOCTOR_FULL_IDENTIFICATION</h1>";

        ?>
    </div>
    <div class="red">
        <h1>
            <a href="doctorEmail.php">Mailbox</a>
        </h1>
    </div>
    <div class="red">
        <h1>
            <a href="writeResults.php">Write Results</a>
        </h1>

    </div>
    <div class="red">
    <h1>
        <a href="pill.php">View Pills</a>
    </h1>

    </div>
<br>
<div class="counterDiv">
    <!-- Images -->
    <img src="pill_img/kisspng-health-care-medicine-emergency-medical-services-ph-cloud-banner-5b39c773853245.9159860815305132675456.png" onclick="imageClick('doctorPortal.php')" height="405px" alt="Girl in a jacket" >
    <!-- Form -->
    <div>


        <form method="post" action="writePrescriptions.php" class="form">
        <br>
        <br>
        <br>
            <?php include('error.php') ?>
        <br>
        <br>
        <label for="patientID">Patient ID:</label>
        <input type="text" id="patientID" name="patientID" placeholder="Patient ID"></input>
        <br>
        <br>
        <br>
        <br>
        <label id="DIN" for="DIN">Drug Identification Number:</label>
        <input type="text" id="DIN" name="DIN" placeholder="DIN"></input>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        <input type="Submit" id="sub_pre" value="Submit" name="sub_pre">

        <p>Only accessible to doctors</p>
        </form>
    </div>
</div>
    </body>


</html>
