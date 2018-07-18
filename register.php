<?php
    
    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
    
    $password = "";
    $id = "";
    $role = "";

    $token = random_str(128);

    if(isset($_POST['pwd'])){
        $password = $_POST['pwd'];
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    if(isset($_POST['role'])){
        $role = $_POST['role'];
    }

    include "checkID.php";

    if (!checkID($id))
    {
        $hash_cmd = escapeshellcmd('python3 hash.py ' . $password . " -s " . $token);
        $hashed = shell_exec($hash_cmd);

        $link = mysqli_connect("localhost", "readwrite", "", "users");

        // Check connection
        if($link === false){
            echo json_encode("ERROR: Could not connect. " . mysqli_connect_error());
        }

        //echo $hashed;
        //echo $token;

        $sql = "INSERT INTO  users(ID, ROLE, HASH, SALT) VALUES('$id', '$role', '$hashed', '$token')";

        if(mysqli_query($link, $sql)){
            echo json_encode(true);
        } else{
            echo json_encode("ERROR: Could not able to execute $sql. " . mysqli_error($link));
        }

        mysqli_close($link);
    }
    
?>