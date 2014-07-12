<?php

include("../lib/view.inc");
include("../lib/mediator.inc");

$view = new View();

$mediator = new Mediator();
$mediator->Initialize($view);
	
if ($_POST['uname']!=""){
	if ($mediator->doLogin( $_POST['uname'],$_POST['upass'] )){
		header("location:dashboard.php");
	}
}

?>

<form enctype="multipart/form-data" action="login.php"  method="POST">
<br>Username: <input type=text name=uname value="" maxlength=32>
<br>Password: <input type=text name=upass value="" maxlength=32/><br />
<input type="submit" value="Login >>" />
</form>

