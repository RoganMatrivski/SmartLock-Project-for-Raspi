<?php

$link = mysqli_connect("localhost", "readwrite", "", "users");

// Check connection
if($link === false){
    echo("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = mysqli_query($link, "SELECT users.ID from users");
$rows = array();

while($rows = mysqli_fetch_assoc($query)) {
    $data[] = $rows["ID"];
}

#header('Content-Type: application/json');

print json_encode($data);

mysqli_close($link);

?>