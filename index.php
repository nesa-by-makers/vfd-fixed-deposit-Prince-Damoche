<?php

$server = "localhost";
$username = "root";
$password = "freshboi";
$database = "vfd_fixed_deposit";

$connection = new mysqli($server, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed" . $connection->connect_error);
}
$firstname = $_POST["firstname"];
$phonenumber = $_POST["phonenumber"];
$residentialaddress = $_POST["residentialaddress"];
$officeaddress = $_POST["officeaddress"];
$occupation = $_POST["occupation"];
$query = "INSERT INTO personal_info (firstname, phonenumber, residentialaddress, occupation, officeaddress) VALUES ('".$firstname."',".$phonenumber.",'".$residentialaddress."','".$occupation."','".$officeaddress."')";

$proposedduration = $_POST["proposedduration"];
$amount = $_POST["amount"];
$payoutid = $_POST["payoutid"];

$query = "INSERT INTO placement_info (proposedduration, amount) VALUES('".$proposedduration."',".$amount.",".$payoutid.")";

// echo $query;
if ($connection->query($query) == true) {
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}
$connection->close();

//if ()

//echo "We have connected to the database successfully!";
//echo "name" . $_POST["name"];
//echo "phonenumber" . $_POST["phonenumber"];
//echo "message" . $_POST["message"];
?>