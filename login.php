 <?php include('server.php'); ?>

<html>

<head>
    <link rel="stylesheet" href="layout.css">
</head>

<div class="center">
<h1 class="header">Welcome to DoChart</h1>
    <?php include('error.php'); ?>
<form method="post" action="login.php">

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