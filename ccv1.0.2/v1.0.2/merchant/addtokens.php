
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
?>

<form method=post action=addtokens.php>
<table>
<tr><td>Tokens</td>
<td><input type=text value=tokens maxlength=3></td>
<td><input type=submit></td>
</tr>
</table>
</form>
