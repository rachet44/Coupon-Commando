<?php

include("./lib/view.inc");
include("./lib/mediator.inc");


$view = new View();

$mediator = new Mediator();
$mediator->Initialize($view);

$view->Initialize($mediator->data, $mediator);
$mediator->SessionCheck();

$array = $mediator->getCouponList();

//TODO:HACK: This really, really needs re-thought.

$match=false;
$id=-1;
foreach($array as $row){
	if (md5($row[0]) == $_GET['s2']){
		$match=true;		
		$id=$row[0];
	}
}

if (!$match){
header("location:index.php");
exit();
}

include("header.inc");

$mediator->useDisplayToken($id);

?>
<script>
function print(){
//alert('load printing page');
f1.submit();
}
</script>

<center>
<a href="index.php">Home</a> | <a href="logout.php">Log out</a>
</center>

<?php

include("./lib/watermark.inc");

$coupon = $mediator->getCoupon($id);
$img = str_replace("../","./",$coupon[0]['imgname']);

echo("<form name=f1 method=post action='printview.php?q=".$_GET['s2']."'>");
echo("<input type=button onclick='print();' value='Print Coupon'>");
echo("<img src='".watermark($img)."'>");


/*

<p>
See this merchant's other offers:
<li> Other Offers #1

*/
?>
