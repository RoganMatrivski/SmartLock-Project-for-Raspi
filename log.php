<?php

$link = mysqli_connect("localhost", "readwrite", "", "users");

// Check connection
if($link === false){
    //echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = mysqli_query($link, "SELECT * FROM logs");

$rows = array();

while($rows = mysqli_fetch_assoc($query)) {
    $data[] = $rows;
}

#header('Content-Type: application/json');

#require("ssp.class.php");

print json_encode($data);
?>