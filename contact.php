<?php include('server.php'); ?>
<!DOCTYPE>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="form.css">
</head>
<body>


<h1 class="header">Contact Form</h1>
<div class="narrow">
    <?php include('error.php'); ?>
<form class="container" action="contact.php" method="POST">

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

    <label for="subject">Message: </label>
    <textarea id="message" name="message"maxlength="200" placeholder="Type your message here" style="height:200px"></textarea>

    <input type="Submit" id="send_contact" value="Submit" name="send_contact">
</form>
</div>
</body>
</html>
