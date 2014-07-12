<?php
session_start();
$_SESSION['token']=0;
session_destroy();
echo("You have logged off.");
exit();
?>
