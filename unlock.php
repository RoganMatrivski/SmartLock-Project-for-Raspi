<?php

include "logging.php";

$id = "";

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

$cmd = escapeshellcmd('sudo python3 /home/pi/sites/unlock.py');
$res = shell_exec($cmd);

logquery($id, "UNLOCK", "SUCCESS");

?>