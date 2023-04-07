<?php
$command = 'ngrok http 3000';
$output = shell_exec($command);
echo $output;
?>
