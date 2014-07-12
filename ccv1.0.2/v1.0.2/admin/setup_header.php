<?php
session_start();

include("../lib/view.inc");
include("../lib/mediator.inc");

$view = new View();

$mediator = new Mediator();
$mediator->Initialize($view);
$mediator->SessionCheck();

if (!$mediator->IsMerchantRole()){
        echo("Invalid role.");
        exit();
}
?>

<center>
<pre><a href="dashboard.php">Dashboard</a> | <a href='setup_couponmanagement.php'>Coupon Management</a> | <a href="setup_onetimeoffer.php">One Time Offers</a> | <a 
href="setup_members.php">Members Maintenance</a> | <a href="setup_rss.php">RSS Feeds</a> | <a href="logout.php?logmeout=true">Logout</a>
</pre>
</center>
