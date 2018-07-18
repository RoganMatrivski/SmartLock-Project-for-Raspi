<?php

function logquery($user, $action, $result)
{
    $link = mysqli_connect("localhost", "readwrite", "rgdatabase", "users");
    $time = date("Y:m:d H:i:s");
    $logquery = "INSERT INTO  logs(TIME, USER, ACTION, RESULT) VALUES(\"$time\", \"$user\", \"$action\", \"$result\")";
    // echo $user;
    // echo $action;
    // echo $result;
    if($res = mysqli_query($link, $logquery)){
        //echo "Done!";
    } else{
        //echo "ERROR: Could not able to execute $logquery. " . mysqli_error($link);
    }
    mysqli_close($link);
}

?>