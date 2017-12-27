<?php
//This file connects to a database and inserts session data into a table
$conn = Connect();

//extracts variables from current session
    $contactFirstName = $conn->real_escape_string($_SESSION["contactFirstName"]);
    $contactLastName = $conn->real_escape_string($_SESSION["contactLastName"]);
    $contactAddress = $conn->real_escape_string($_SESSION["contactAddress"]);
    $contactCity = $conn->real_escape_string($_SESSION["contactCity"]);
    $contactState = $conn->real_escape_string($_SESSION["contactState"]);
    $contactZipCode = $conn->real_escape_string($_SESSION["contactZipCode"]);
    $contactPhone = $conn->real_escape_string($_SESSION["contactPhone"]);
    $contactEmail = $conn->real_escape_string($_SESSION["contactEmail"]);
    $contactComments = $conn->real_escape_string($_SESSION["contactComments"]);
    $contactDate = date("Y/m/d");

//insert into database
    $query   = "INSERT into contactsTable (contactFirstName,contactLastName,contactAddress,contactCity,contactState,contactZipCode,contactPhone,contactEmail,contactComments,contactDate) 
    VALUES('" . $contactFirstName . "','" .             
                $contactLastName . "','" .
                $contactAddress . "','" .
                $contactCity . "','" .
                $contactState . "','" .
                $contactZipCode . "','" .
                $contactPhone . "','" .
                $contactEmail . "','" .
                $contactComments . "','" .
                $contactDate . "')";
                $success = $conn->query($query);
    
    if (!$success) {
        die("Couldn't enter data: ".$conn->error);   
    }

$conn->close();//closes the connection
$_SESSION = array();//clears the session array
session_destroy();//ends the session
   
?>