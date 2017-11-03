<?php

$server = "localhost";
$username = "root";
$password = "freshboi";
$database = "vfd_fixed_deposit";

$connection = new mysqli($server, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed" . $connection->connect_error);
}    

    $vfduser = $_POST["username"]; 
    $vfdpass = $_POST["password"]; 

    $query1 = "SELECT * FROM admin;";
    

    $x = $connection->query($query1);
    $getdetails = $x->fetch_assoc();
    

    $getpassword = $getdetails['password'];
    $getusername = $getdetails['username'];
    
    
    

    if(($getpassword == $vfdpass)  && ($getusername == $vfduser))
    { 
    
        echo 'Login successfully';
    }
    else
    {
        echo'The username or password are incorrect!';
    }
 

$connection->close();
?>