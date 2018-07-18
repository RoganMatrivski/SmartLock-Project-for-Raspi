<?php

function checkID($id)
{
    $link = mysqli_connect("localhost", "readwrite", "", "users");

    $sql = "select id from users where id=\"$id\"";

    if($res = mysqli_query($link, $sql)){
        if(mysqli_num_rows($res))
        {
            return true;
        }
        else
        {
            return false;
        }
    } else{
        return false;
    }
}

// $id="";

// if(isset($_POST['id'])){
//     $id = $_POST['id'];
// }

// echo checkID(($id));

?>