<?php

	include("setup_header.php");

?>


<center>
<form method=post action=memberadmin.php>
<table width=50% >
<tr valign=top>

<td>
<li><a href="../signup_as_merchant.php">Add Merchant</a>
<li><a href="../signup_for_coupons.php">Add User</a>
</td>
<!--<td><a href="setup_members.php?key=updaterole">Update Role</a></td>-->
<td><input type=submit name=btnAction value="Delete Selected"></td>
<!--<td><a href="setup_members.php?key=ban">Ban Selected</a></td>-->
</tr>
</table>

Users List

<table>

<p><br><br>
<?php

$result = $mediator->GetAllUsers();
foreach($result as $row){
	echo("<INPUT TYPE=CHECKBOX NAME='cbUser[]' VALUE='".$row['id']."'> {".$row['user']."}".$row['first_name']." ".$row['last_name']." (".$row['account_type'].") | <a href='mailto:".$row['email']."'>".$row['email']."</a><br>");
}
?>

</p>
</table>

<?php

if (strlen($_GET['key'])>1){
	echo("<p><hr></p>");
}

if ($_GET['key']=="add"){
	echo("Email : <input type='text' name='email' value=''>	
	<br>
	Password : <input type='text' name='passwd' value=''>");
}

if ($_GET['key'] =="ban"){
	echo("<center><h4>Are you sure you want to ban the selected users?</h4>");
	echo("YES or NO");
}

if ($_GET['key'] =="delete"){
	echo("<center><h4>Are you sure you want to forever delete the selected users?</h4>");
	echo("YES or NO");
}


if ($_GET['key']=="updaterole"){
        echo("Select the new role for these users : 
	<select name='role'>
	<option value='freeuser'>Free user</option>
	<option value='premiumuser'>Premium user</option>
	<option value='freemerchant'>Free Merchant</option>
	<option value='premiummerchant'>Premium Merchant</option>

	</select>

");

}


?>

</form>
</center>
</body>
</html>
