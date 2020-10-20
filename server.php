<?php

/**
 *  This involves the connection to the database
 */
$host = "localhost";
$user = "root";
$password = "10006778";
$port = "3306";
$db = "dochart";

# The connection
$con = mysqli_connect($host, $user, $password, $db) or die("Failed");

$errors = array(); # This stores all the errors so they can be displayed on the register / login page

/**
 *  If the user is on the register page - register.php
 */
if (isset($_POST['register']))
{
    // Regards the user login information
    $user1 = mysqli_real_escape_string($con, $_POST['username']);
    $pass1 = mysqli_real_escape_string($con, $_POST['pass']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    //  Regards to the the users full name
    $first = mysqli_real_escape_string($con, $_POST['first']);
    $middle = mysqli_real_escape_string($con, $_POST['middle']);
    $last = mysqli_real_escape_string($con, $_POST['last']);
    // Other information regarding the user
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
    $bloodType = mysqli_real_escape_string($con, $_POST['blood']);
    $insurance = mysqli_real_escape_string($con, $_POST['insurance']);
    // Statements that insure that all the fields are filled properly
    if (empty($user1))
    {
        array_push($errors, "Username required!");
    }
    if (empty($pass1))
    {
        array_push($errors,"Password is required!");
    }
    if (empty($pass2) and (!(empty($pass1))))
    {
        array_push($errors,"Must re-enter password");
    }
    if($pass1 != $pass2 and (!(empty($pass1))) and (!(empty($pass2))))
    {
        array_push($errors,"Passwords do not match!");
    }
    if (empty($first))
    {
        array_push($errors,"User must enter first name!");
    }
    if (empty($middle))
    {
        array_push($errors,"User must enter middle initial");
    }
    if (strlen($middle) > 1)
    {
        array_push($errors,"Please only enter initial!");
    }
    if (empty($last))
    {
        array_push($errors,"User must enter last name!");
    }
    if (empty($birthday))
    {
        array_push($errors,"User must select their birthday!");
    }
    if (empty($bloodType))
    {
        array_push($errors,"Enter blood or type n/a");
    }
    if (empty($insurance))
    {
        array_push($errors,"Enter Insurance or type n/a");
    }
    # If this is greater that 0 that means that there are error with the fields
    if (sizeOf($errors) == 0)
    {
        $query = "SELECT * FROM patient WHERE pUsername='$user1'";
        $patientSetter = rand(0,9999999);
        $test = "SELECT patientID FROM patient WHERE patientID = $patientSetter ";
        $check = mysqli_query($con, $test);
        // This insures that multiple users cant have the same patientID
        if (mysqli_num_rows($check) == 1)
    {
        $patientSetter++; # If they do equal increment the number (prevention)
    }
        // Involves with insert and adding the patients information to the database
        $queryTwo = "INSERT into patient VALUES ($patientSetter,'$first','$middle','$last','$user1','$pass1','$bloodType','$insurance','$birthday')";
        $result = mysqli_query($con, $query);
        // Means that the username is taken
        if(mysqli_num_rows($result) == 1)
        {
            array_push($errors,"Username is taken");

        }
        // Means that all the requirements are MET - USER is added to the database
        else if (mysqli_num_rows($result) == 0)
        {
          mysqli_query($con,$queryTwo);
            header('location: patientScreen.php');
            exit();
        }
        else
        {
            array_push($errors,"Error has occurred!");

        }

    }//sizeof

}

/**
 *  If the user is on the login page - login.php
 */

else if (isset($_POST['login']))
{
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    // Insures that the username and password fields are entered properly
    if (empty($username))
    {
        array_push($errors, "Username required!");
    }
    if (empty($pass))
    {
        array_push($errors,"Password is required!");
    }

    // If all the conditions are met they wil go inside of here (login process will begin)
    if (sizeOf($errors) == 0)
    {
        $query = "SELECT * FROM patient WHERE pUsername='$username' AND pPassword='$pass'";
        $queryTwo = "SELECT * FROM patient WHERE pUsername='$username'";
        $result = mysqli_query($con, $query);
        $resultTwo = mysqli_query($con, $queryTwo);

        if (mysqli_num_rows($result) == 1)
        {
            session_start();


            // This is here because doctors have a different screen
            /***
             *  This needs to be change to read in all the doctors usernames !
             */
            if ($username == 'doctor')
            {

                header('location: pill.php'); # Create doctor screen
                exit();
            }
            else
            {
                // Patients login information goes here
                header('location: patientScreen.php?username='.$username );
                exit();
            }
        }
        else if(mysqli_num_rows($resultTwo) == 1)
        {
            // If the username exist then...
            array_push($errors,"Wrong Username/Password!");

        }
        else
            {
            // If the username entered does not exist
            array_push($errors,"User does not exist!");
        }
    }//sizeof

}