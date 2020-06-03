<?php 




$command = escapeshellcmd('/usr/custom/scripts/01946-Dante.php');

$output = shell_exec($command);

echo $output;