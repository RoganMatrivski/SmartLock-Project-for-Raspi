<?php
    include "logging.php";

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

    if(isset($_POST['pwd'])){
        $password = $_POST['pwd'];
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    // echo $id;
    // echo $password;
    // echo "fuck";

    $link = mysqli_connect("localhost", "readwrite", "", "users");

    // Check connection
    if($link === false){
        echo("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $token = "";

    $tokenquery = "select SALT from users where id=\"$id\"";
    
    $tokenres = mysqli_query($link, $tokenquery);

    while($tokenrow = mysqli_fetch_assoc(($tokenres)))
    {
        $token = $tokenrow['SALT'];
    }

    $hashquery = "select HASH from users where id=\"$id\"";
    
    $hashres = mysqli_query($link, $hashquery);

    while($hashrow = mysqli_fetch_assoc(($hashres)))
    {
        $hash = $hashrow['HASH'];
    }

    $hash_cmd = escapeshellcmd('python3 hash.py ' . $password . " -s " . $token);
    $hashed = shell_exec($hash_cmd);

    //echo $hashed;
    
    $sql = "select id from users where id=\"$id\"";
    $sql2 = "select id from users where id=\"$id\"";

    if($res = mysqli_query($link, $sql)){
        //echo "Connected";
    } else{
        echo "ERROR: Could not able to execute $sql. \n" . mysqli_error($link);
    }

    //$bool = $hashed === $hash;

    $hash = str_replace("\r", "", $hash);
    $hash = str_replace("\n", "", $hash);
    $hashed = str_replace("\r", "", $hashed);
    $hashed = str_replace("\n", "", $hashed);

    //$arr = array($hash, $hashed);

    //echo(json_encode($arr));

    if(mysqli_num_rows($res))
    {
        if($hashed === $hash)
        {
            
            logquery($id, "LOGIN", "SUCCESS");
            echo json_encode(true);
            //header('Location: main.html');
        }
        else
        {
            //echo("Not Match");
            logquery($id, "LOGIN", "FAILED");
            echo json_encode(false);
            //header('Location: main.html');
        }
    }
    else
    {
        logquery($id, "LOGIN", "FAILED");
        echo json_encode(false);
    }

    mysqli_close($link);
?>