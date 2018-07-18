<?php
    $id = "";
    $adasdasd = "";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    if(isset($_POST['adasdasd'])){
        $adasdasd = $_POST['adasdasd'];
    }

    //echo($id . $adasdasd);

    $link = mysqli_connect("localhost", "readwrite", "", "users");

    // Check connection
    if($link === false){
        echo json_encode("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "DELETE FROM users WHERE users.id=\"$id\"";

    if(mysqli_query($link, $sql)){
        echo json_encode(true);
    } else{
        echo json_encode("ERROR: Could not able to execute $sql. " . mysqli_error($link));
    }

    mysqli_close($link);
?>