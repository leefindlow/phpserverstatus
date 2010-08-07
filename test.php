<?php
echo ini_get('user_agent');
include('./ServerStatus.class.php');
//Server status test script
$ss = new	ServerStatus();
var_dump($ss->ServerStatus($_GET['hostname'],$_GET['port'], true));
?>
