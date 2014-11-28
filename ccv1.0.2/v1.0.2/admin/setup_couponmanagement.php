<?php
include("setup_header.php");
?>



<center>
<form method=post action=couponadmin.php>
<table width=50% >
<tr valign=top>
<td><a href="../merchant/dashboard.php">Merchant Dashboard</a></td>
<td><input type=submit name=btnAction value="Delete Selected"></td>
</tr>
</table>


<?php

$result = $mediator->GetAllCoupons();
foreach($result as $row){
        echo("<INPUT TYPE=CHECKBOX NAME='cbCoupon[]' VALUE='".$row['id']."'>".$row['name']."<br>");
}
?>


<hr>


</form>
</table>
</center>
