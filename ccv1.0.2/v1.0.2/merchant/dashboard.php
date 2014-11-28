<?php
session_start();

include("../lib/view.inc");
include("../lib/mediator.inc");

$view = new View();

$mediator = new Mediator();
$mediator->Initialize($View);
$mediator->SessionCheck();

if (!$mediator->IsMerchantRole()){
	echo("Invalid role.");
	exit();
}

function getContent() {
return "<li><a href=\"fileupload.php\">Add Coupon</a>
<!--<li><a href=\"\">Purchase One Time Offer Placement</a>-->
<!--<li><a href=\"addtokens.php\">Add Placement Tokens</a>-->
<!--<li><a href=\"list.php\">List My Coupons</a>-->
<br>
<li><a href='logout.php'>Logout</a>";

}

$templatecontent = "../templates/base_template/contentonly.htm";

$content = getContent();

$res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
echo $res;


?>
