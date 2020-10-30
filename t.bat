ECHO OFF
 <?php include('server.php'); ?>

 <script type="text/javascript">
     window.history.forward();
     function noBack()
     {
         window.history.forward();
     }
 </script>

 <?php


 $alreadyLogged = file_get_contents("form-save.txt");


 if($alreadyLogged != NULL)
 {
     header('location: patientScreen.php?username=' . $alreadyLogged);
     exit();
 }


 ?>
<html>

<head>
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
    </div>

</form>
</div>
</html>
PAUSE
