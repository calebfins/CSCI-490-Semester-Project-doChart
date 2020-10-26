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


// Check connection
if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $con -> connect_error;
    exit();
}
else{
    echo "Connection successful";
}
