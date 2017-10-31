<?php

$server = "localhost";
$username = "root";
$password = "freshboi";
$database = "vfd_fixed_deposit";

$connection = new mysqli($server, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed" . $connection->connect_error);
}

$personalinfo = $connection->prepare("INSERT INTO personal_info (firstname, phonenumber, residentialaddress, occupation, officeaddress) VALUES (?,?,?,?,?)");


$firstname = $_POST["firstname"];
$phonenumber = $_POST["phonenumber"];
$residentialaddress = $_POST["residentialaddress"];
$officeaddress = $_POST["officeaddress"];
$occupation = $_POST["occupation"];
$customerid = $connection->insert_id;

$personalinfo->bind_param('ssiss',$firstname,$phonenumber,$residentialaddress,$officeaddress,$occupation);


if ($personalinfo->execute() == true) {
    $customerid = $connection->insert_id;
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}

$payoutdetails = $connection->prepare("INSERT INTO payout_details (accountnumber, accountname, nameofbank, customerid) VALUES (?,?,?,?)");

$accountnumber = $_POST["accountnumber"];
$accountname = $_POST["accountname"];
$nameofbank = $_POST["nameofbank"];

$payoutdetails->bind_param('issi',$accountnumber,$accountname,$nameofbank,$customerid);


if ($payoutdetails->execute() == true) {
    $payoutid = $connection->insert_id;
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}

$placementinfo = $connection->prepare("INSERT INTO placement_info (proposedduration, amount, payoutid) VALUES (?,?,?)");

$proposedduration = $_POST["proposedduration"];
$amount = $_POST["amount"];

$placementinfo->bind_param('sss',$proposedduration,$amount,$payoutid);


if ($placementinfo->execute() == true) {
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}

$nextofkin = $connection->prepare("INSERT INTO nextofkin (name, phonenumber, email, reference, customerid) VALUES (?,?,?,?,?)");

$name = $_POST["name"];
$phonenumber = $_POST["phonenumber"];
$email = $_POST["email"];
$reference = $_POST["reference"];

$nextofkin->bind_param('sissi',$name,$phonenumber,$email,$reference,$customerid);

if ($nextofkin->execute() == true) {
    $customerid = $connection->insert_id;
    echo "Accepted process";
} else {
    echo "Unaccepted process" .$connection->error;
}
$connection->close();
?>