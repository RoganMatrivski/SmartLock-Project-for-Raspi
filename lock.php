<?php

include "logging.php";

$id = "";

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

echo $id;

$cmd = escapeshellcmd('sudo python3 /home/pi/sites/lock.py');
$res = shell_exec($cmd);

echo $cmd;

echo $res;

echo(logquery($id, "LOCK", "SUCCESS"));

?>