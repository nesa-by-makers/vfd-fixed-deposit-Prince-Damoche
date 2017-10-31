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
$customerid = $connection->insert_id;

$query1 = "INSERT INTO personal_info (firstname, phonenumber, residentialaddress, occupation, officeaddress) 
               VALUES ('".$firstname."','".$phonenumber."','".$residentialaddress."','".$occupation."','".$officeaddress."')";

if ($connection->query($query1) == true) {
    $customerid = $connection->insert_id;
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}

$accountnumber = $_POST["accountnumber"];
$accountname = $_POST["accountname"];
$nameofbank = $_POST["nameofbank"];


$query2 = "INSERT INTO payout_details (accountnumber, accountname, nameofbank, customerid) 
        VALUES ('".$accountnumber."','".$accountname."','".$nameofbank."','".$customerid."')";
        if ($connection->query($query2) == true) {
            $payoutid = $connection->insert_id;
            echo "Accepted process";
        } else {
            echo "Unaccepted process" .$connection->error;
        }

$proposedduration = $_POST["proposedduration"];
$amount = $_POST["amount"];

$query3 = "INSERT INTO placement_info (proposedduration, amount, payoutid) VALUES('".$proposedduration."',".$amount.",'".$payoutid."')";

if ($connection->query($query3) == true) {
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}
$name = $_POST["name"];
$phonenumber = $_POST["phonenumber"];
$email = $_POST["email"];
$reference = $_POST["reference"];

$query4 = "INSERT INTO nextofkin (name, phonenumber, email, reference, customerid) 
               VALUES ('".$name."','".$phonenumber."','".$email."','".$reference."','".$customerid."')";


if ($connection->query($query4) == true) {
    $customerid = $connection->insert_id;
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}
$connection->close();
?>