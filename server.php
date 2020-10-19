<?php

$host = "localhost";
$user = "root";
$password = "10006778";
$port = "3306";
$db = "dochart";

$con = mysqli_connect($host, $user, $password, $db) or die("Failed");

$errors = array();




if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if (empty($username))
    {
        array_push($errors, "Username required!");
    }
    if (empty($pass))
    {
        array_push($errors,"Password is required!");
    }


    if (sizeOf($errors) == 0) {
        $query = "SELECT * FROM patient WHERE pUsername='$username' AND pPassword='$pass'";
        $queryTwo = "SELECT * FROM patient WHERE pUsername='$username'";
        $result = mysqli_query($con, $query);
        $resultTwo = mysqli_query($con, $queryTwo);

        if (mysqli_num_rows($result) == 1) {
            session_start();

            if ($username == 'doctor')
            {
                header('location: pill.php');
                exit();
            }
            else
            {
                header('location: patientscreen.php');
                exit();
            }
        }
        else if(mysqli_num_rows($resultTwo) == 1){
            array_push($errors,"Wrong Username/Password!");

        }
        else {

            array_push($errors,"User does not exist!");
        }
    }//sizeof

}