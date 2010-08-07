<?php
include('./ServerStatus.class.php');
header('content-type:text/plain');
print_r($_GET);
//Server status test script
$ss = new	ServerStatus();
var_dump($ss->ServerStatus($_GET['hostname'],$_GET['port'], false));
?>
