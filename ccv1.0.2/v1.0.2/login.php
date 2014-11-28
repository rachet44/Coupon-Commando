<?php
session_start() or die ("Cookies must be enabled.");
include("header.inc");
include("template.inc");

include("./lib/view.inc");
include("./lib/mediator.inc");

$template= new Template();
$view = new View();

$mediator = new Mediator();
$mediator->Initialize($view);

if ($_POST['uname']!=""){
        if ($mediator->doLogin( $_POST['uname'],$_POST['upass'] )){
                header("location:index.php");
        }else{
		header("location:index.php?k="."Bad username or password");
//		echo("Bad username or password.");
	}
}

exit();
?>

<?php echo( $template->login_toptext); ?>

<form method=post action=login.php>
<table>
<tr>
<td><?php echo($template->login_username); ?></td><td> <input type=text name=uname></td>
</tr><tr>
<td><?php echo($template->login_password);?></td><td> <input type=password name=upass></td>
</tr>
<tr>
<td></td><td><input type=submit value="<?php echo($template->login_submit);?>"></td>
</tr>
</table>
</form>
