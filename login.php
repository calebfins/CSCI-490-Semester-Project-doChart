 <?php include('server.php');

 $result = " ";?>



 <?php


 $alreadyLogged = file_get_contents("form-save.txt");

 /**
  *  Make sure the doctor goes to the correct screen
  */
 if($alreadyLogged != NULL)
 {

     // If a doctor it needs to go to the correct screen
     $check = "SELECT * FROM doctor WHERE dUsername='$alreadyLogged'";
     if (isset($con)) {
         $result = mysqli_query($con, $check);
     }
     if (mysqli_num_rows($result) > 0)
     {
         header('location: doctorPortal.php?username=' . $alreadyLogged);
         exit();
     }
     else {
         header('location: patientScreen.php?username=' . $alreadyLogged);
         exit();
     }
 }


 ?>
<html>

<head>
    <title>DoChart - Login</title>
    <link rel="stylesheet" href="layout.css">
</head>
</head>

<div class="center">
<h1 class="header">Welcome to DoChart</h1>
    <?php include('error.php'); ?>
<form method="POST" action="login.php">

    <div class="input-group">
        <label class="label">Username:</label>
        <input type="text" name="username" id="username" placeholder="Username">

    </div>

    <div class="input-group">
        <label class="label">Password:</label>
        <input type="password" name="pass" id="pass" placeholder="Password">
    </div>


    <div class="input-group">
        <button id="login" class="btn" type="submit" name="login" href="pill.php">Login</button>
        <p class="fb">Need to register?  <a href="register.php">Register Here</a></p>
    </div>

</form>
</div>
</html>