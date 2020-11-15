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


/***
 *  This adds the patients prescription to the database
 *
 */
if (isset($_POST['sub_pre']))
{

    $patientIdentification = mysqli_real_escape_string($con, $_POST['patientID']);
    $DIN = mysqli_real_escape_string($con, $_POST['DIN']);
    $stat = "SELECT  * FROM patient WHERE patientID='$patientIdentification'";
    $chec = mysqli_query($con, $stat);
    if(mysqli_num_rows($chec) == 0)
    {
        array_push($errors,"Patient doesn't exist!");
    }
    if(empty($patientIdentification))
    {
        array_push($errors,"Patient ID required");
    }
    if(!(is_numeric($patientIdentification)) AND !(empty($patientIdentification)))
    {
        array_push($errors,"Patient ID incorrect!");
    }
    $stat2 = "SELECT  * FROM prescription WHERE DIN='$DIN'";
    $check = mysqli_query($con, $stat2);
    if(mysqli_num_rows($check) == 0)
    {
        array_push($errors,"DIN doesn't exist!");
    }
    if(empty($DIN))
    {
        array_push($errors,"DIN required!");
    }
    if(!(is_numeric($DIN)) AND !(empty($DIN)))
    {
        array_push($errors,"DIN incorrect!");
    }

    // This is where the adding process takes place !
    if (sizeof($errors) == 0)
    {
        $statement = "INSERT INTO patient_has_prescription VALUES ($patientIdentification, '$DIN')";
        mysqli_query($con,$statement);
    }
}












/***
 *  This allows the doctor to submit the results
 *
 */
if (isset($_POST['REPORT']))
{
    $patientIdentification = mysqli_real_escape_string($con, $_POST['PID']);
    $patientResults = mysqli_real_escape_string($con, $_POST['results']);
    // Making sure the patient ID is in the database
    $stat = "SELECT  * FROM patient WHERE patientID='$patientIdentification'";
    $chec = mysqli_query($con, $stat);
    if(mysqli_num_rows($chec) == 0)
    {
        array_push($errors,"Incorrect Patient ID");
    }
    if(empty($patientIdentification))
    {
        array_push($errors,"Patient ID must be entered");
    }
    if(empty($patientResults))
    {
        array_push($errors,"Result field can't be left blank");
    }
    if(!(is_numeric($patientIdentification)) AND !(empty($patientIdentification) ))
    {
        array_push($errors,"Patient ID is incorrect");
    }
    
    // This means everything checks out
    if (sizeof($errors) == 0)
    {
        $send = file_get_contents("form-save.txt");
        $statement = "INSERT INTO result VALUES ($patientIdentification, '$patientResults')";
        mysqli_query($con,$statement);
        header('location: doctorPortal.php?username=' . $send);
        exit();
    }
}//REPORT
/***
 *
 * This involves booking the appointments
 */
if (isset($_POST['send_book']))
{
    date_default_timezone_set("America/New_York");


    // This regards to the information about booking appointments
    $patientIdentification = mysqli_real_escape_string($con, $_POST['PID']);
    $patientUsername= mysqli_real_escape_string($con, $_POST['username']);
    $doctorIdentification= mysqli_real_escape_string($con, $_POST['doctors']);
    $reason = mysqli_real_escape_string($con, $_POST['reason']);
    $height = mysqli_real_escape_string($con, $_POST['height']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $symptoms = mysqli_real_escape_string($con, $_POST['symptoms']);
    $time =  date("h:i");
    $m = mysqli_real_escape_string($con, $_POST['date']);
    # 2020-11-25
    $date = $m[5] . $m[6] . "/" . $m[8] . $m[9] . "/" . $m[0] . $m[1] . $m[2] . $m[3];
    $fill = 10101010;
    $appID = rand(90000,99999);

    // Meets the requirements so  can be added!
    if (empty($patientUsername))
    {
        array_push($errors,"Patient username is needed!");
    }
    if(empty($patientIdentification))
    {
        array_push($errors,"Patient identification is needed!");
    }
    if(empty($doctorIdentification))
    {
        array_push($errors,"Patient must select doctor!");
    }
    if(empty($reason))
    {
        array_push($errors,"Reason must be filled out");
    }
    if(empty($height))
    {
        array_push($errors,"Height must be entered or n/a");
    }
    if(empty($weight))
    {
        array_push($errors,"Weight must be entered or 0");
    }

    if(empty($symptoms))
    {
        array_push($errors,"Symptoms can't be left blank");
    }

    if(sizeof($errors)==0)
    {

        $query = "INSERT INTO appointment VALUES ($appID, '$reason', '$height',$weight, '$symptoms','$time','$date', '$patientIdentification')";
        mysqli_query($con,$query);
        $query2 = "INSERT INTO patient_has_appointment VALUES ($patientIdentification,$doctorIdentification, $appID)";
        mysqli_query($con,$query2);
       header('location: patientScreen.php?username=' . $patientUsername);
       exit();
    }
}//send_book

/***
 *  This involves sending the patients message to the doctor. So, the doctor can contact them.
 */
if (isset($_POST['send_contact']))
{

    // This regards to the information being sent to the doctor
    $patientIdentification = mysqli_real_escape_string($con, $_POST['PID']);
    $patientUsername= mysqli_real_escape_string($con, $_POST['username']);
    $doctorIdentification= mysqli_real_escape_string($con, $_POST['doctors']);
    $message =  mysqli_real_escape_string($con, $_POST['message']);

         // Meets the requirements so it can be added!
         if (empty($patientUsername))
        {
            array_push($errors,"Patient username is needed!");
        }
        if(empty($patientIdentification))
        {
            array_push($errors,"Patient identification is needed!");
        }
        if(empty($doctorIdentification))
        {
            array_push($errors,"Patient must select doctor!");
        }
        if(empty($message))
        {
            array_push($errors,"Field can't be left blank");
        }


        // If all the requirements are met then it will be added to the database
    if (sizeof($errors) == 0) {
        // Adding the message into the database
        $query = "INSERT INTO contactdoctor VALUES ('$message',$patientIdentification,$doctorIdentification)";
        mysqli_query($con,$query);
        header('location: patientScreen.php?username=' . $patientUsername);
        exit();
    }



}


/**
 *  If the user is on the register page - register.php
 */
if (isset($_POST['register']))
{
    file_put_contents("form-save.txt", "");
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
            // Saves the users, username to the file
            extract($_REQUEST);
            $file = fopen("form-save.txt", "a");
            fwrite($file, $user1 . "");

            fclose($file);

            mysqli_query($con,$queryTwo);
            header('location: patientScreen.php?username='.$user1);
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
        $queryThree = "SELECT * FROM doctor WHERE dUsername='$username' AND dPassword='$pass'";

        $result = mysqli_query($con, $query);
        $resultTwo = mysqli_query($con, $queryTwo);
        $resultThree = mysqli_query($con, $queryThree);

        if (mysqli_num_rows($result) == 1)
        {

                extract($_REQUEST);
                $file = fopen("form-save.txt", "a");
                fwrite($file, $username . "");

                fclose($file);

                $send = file_get_contents("form-save.txt");

                // Patients login information goes here
                header('location: patientScreen.php?username='.$send );
                exit();

        }
        else if(mysqli_num_rows($resultTwo) == 1)
        {
            // If the username exist then...
            array_push($errors,"Wrong Username/Password!");

        }
        else if(mysqli_num_rows($resultThree) == 1)
        {
            // If the username exist then a doctor
            extract($_REQUEST);
            $file = fopen("form-save.txt", "a");
            fwrite($file, $username . "");

            fclose($file);

            $send = file_get_contents("form-save.txt");

            // Patients login information goes here
            header('location: doctorPortal.php?username='.$send );
            exit();

        }

        else
            {
            // If the username entered does not exist
            array_push($errors,"User does not exist!");
        }
    }//sizeof



    //

    if (isset($_POST['message']))
    {
        header('location: patientScreen.php');
        exit();
    }
}