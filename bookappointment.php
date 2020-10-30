<?php include('server.php'); ?>
<!DOCTYPE>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="form.css">
    <style>

        body {
            background-image: url('pill_img/bookbg..jpg');
        }

    </style>
</head>
<body>
<?php

?>

<h1 class="head">Book Appointment</h1>
<div class="narrow">
    <?php include('error.php'); ?>
    <form class="container" action="bookAppointment.php" method="POST">

        <label for="patientID">Patient Username:</label>
        <input type="text" id="username" name="username" placeholder="Username">

        <label for="patientID">Patient ID:</label>
        <input type="text" id="PID" name="PID" placeholder="Patient Identification Number...">

        <label for="doctors">Select a Doctor:</label>
        <select id="doctors" name="doctors">
            <option class="normal" value="">----Select Doctor----</option>
            <option value="22210085">Dr. Samuel Miller</option>
            <option value="22210086">Dr. Rachel Porter</option>
            <option value="22210087">Dr. Liam Daniel</option>
        </select>

        <label>Reasoning for visit: </label>
        <textarea id="reason" name="reason"maxlength="200" placeholder="Type your message here" style="height:200px"></textarea>

        <label for="Height">Height:</label>
        <input type="text" id="height" name="height" placeholder="Height">

        <label for="Weight">Weight:</label>
        <input type="text" id="weight" name="weight" placeholder="Weight">

        <label for="symptoms">Symptoms:</label>
        <input type="text" id="symptoms" name="symptoms" placeholder="Symptoms">

        <input type="Submit"  class="re" id="send_book" value="Book" name="send_book">
    </form>
</div>
</body>
</html>
