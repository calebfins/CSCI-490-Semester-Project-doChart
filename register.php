<?php include('server.php'); ?>
<html>
<head>
    <link rel="stylesheet" href="layout.css">
    <style>

        body
        {
            background-image: url('pill_img/portal.png');

        }
    </style>
</head>
    <div class="center" class="form">
        <form method="post" action="register.php" class="form">
            <h1 class="header">DoChart Registration</h1>
            <?php include('error.php'); ?>
            <div class="input-group">
                <label class="label">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="input-group">
                <label class="label">Password:</label>
                <input type="password" name="pass" id="pass" placeholder="Password">
            </div>

            <div class="input-group">
                <label class="label">Re-Enter password:</label>
                <input type="password" name="pass2" id="pass2" placeholder="Password">
            </div>

            <div class="input-group">
                <label class="label">First Name:</label>
                <input type="text" name="first" id="first" placeholder="First Name">
            </div>
            <div class="input-group">
                <label class="label">Middle Initial:</label>
                <input type="text" name="middle" id="middle" placeholder="Middle Initial or n/a">
            </div>
            <div class="input-group">
                <label class="label">Last Name:</label>
                <input type="text" name="last" id="last" placeholder="Last Name">
            </div>

            <div class="input-group">
                <label class="label">Birthday:</label>
                <input type="date" id="birthday" name="birthday">
            </div>

            <div class="input-group">
                <label class="label">Blood Type:</label>
                <input type="text" name="blood" id="blood" placeholder="BloodType">
            </div>

            <div class="input-group">
                <label class="label">Insurance:</label>
                <input type="text" name="insurance" id="insurance" placeholder="Insurance, if none enter n/a">
            </div>

            <!-- When the register button is clicked -->
            <div class="input-group">

                <button id="register" class="btn" type="submit" name="register" href="pill.php">Register</button>
            </div>



</html>
