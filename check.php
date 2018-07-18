<?php

$cmd = escapeshellcmd('sudo python3 /home/pi/sites/checkstate.py');
$res = shell_exec($cmd);

print $res;

?>