<?php

	include("./setup_header.php");

?>

<li><a href="setup_onetimeoffer_add.php">Setup new one time offer</a>

<center>
<form method=post action=onetimeofferadmin.php>
<table width=50% >
<tr valign=top>
<td>

</td>
<td><input type=submit name=btnAction value="Delete Selected"></td>
<td><input type=submit name=btnAction value="Edit Selected"></td>
</tr>
</table>

Users List

<table width=50%>
<tr>
        <td>offer name</td>
        <td>tokens remaining</td>
</tr>

<p><br><br>
<?php

$result = $mediator->GetAllOneTimeOffers();
foreach($result as $row){
        echo("<tr><td><INPUT TYPE=CHECKBOX NAME='cbOneTimeOffers[]' VALUE='".$row['id']."'>".$row['name']."</td><td>".$row['displaytokens']."</td></tr>");
}
?>

</p>
</table>

