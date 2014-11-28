<?php

	include("./setup_header.php");

if (is_numeric($_GET['id'])) {
	$sql = "select * from cc_onetimeoffers where id=".$_GET['id'];
	$savedresult = $mediator->data->DoQuery($sql);
}
?>

<hr>

<center>
<table width=50% >
<form method=post action=onetimeofferadmin.php>

<tr valign=top>
	<td><b>Select Merchant Account</b></td>
<td>
<select name=maccount>
<?php

if ($savedresult != ""){
	echo("<option value='".$savedresult[0]['id']."'>(Keep Merchant Account)</option>");
}

//print_r($savedresult);

$result = $mediator->GetAllUsers();
foreach($result as $row){
	
	if ($row['account_type']=="m"){
		echo("<option value='".$row['id']."'>".$row['first_name']." ".$row['last_name']."(".$row['company_name'].")"."</option>");
	}
}
?>
</select>

</td>
</tr>

<tr valign=top>
	<td><b>Placement</b></td>
	<td>

<?php

$result = $mediator->GetAllCoupons();
foreach($result as $row){
        echo("<INPUT TYPE=radio NAME='cbCoupon' VALUE='".$row['id']."'>".$row['name']."<br>");
}
?>

	<INPUT TYPE=CHECKBOX NAME="cbGlobal"  CHECKED>Rotate on entire site<br>
	</td>
</tr>


<tr valign=top>
	<td><b>Offer Name</b></td>
	<td><input type=text name=offer_name value="<?php echo($savedresult[0]['name']);?>"></td>
</tr>
<tr valign=top>
	<td><b>Offer HTML</b><br>Enter the HTML for this one-time offer. 
The HTML will be embed into the page. Disallowed tags are 
<xmp><HTML>,<BODY>,<SCRIPT></xmp> </td>
	<td width=450 ><textarea NAME=WEBHTML cols=40 rows=22><?php echo $savedresult[0]['webhtml'];?></textarea></td>
</tr>
<tr valign="top">
	<td><b>Credits</b><br>This is the number of times the offer 
will display. Values of 0 or less will disable the offer from 
display.</td>
	<td><input type=text name=CREDITS value="<?php echo $savedresult[0]['displaytokens']?>"></td>
	<input type=hidden name=updateid value="<?php echo $savedresult[0]['id'];?>">
</tr>
<tr><td/><td><input type=submit value="Create Offer >>"></td></tR>
</form>
</table>
</center>
