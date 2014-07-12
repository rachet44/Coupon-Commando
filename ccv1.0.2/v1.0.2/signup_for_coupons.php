<?php
session_start() or die ("Cookies must be enabled.");

include("./lib/view.inc");
include("./lib/mediator.inc");

//include("header.inc");

$view = new view();

$mediator = new Mediator();
$mediator->Initialize($view);

$view->Initialize($mediator->data, $mediator);

//TODO: These should be defined in GLOBALS
$template = "./templates/base_template/index.htm";
$templatecontent = "./templates/base_template/contentonly.htm";

include("template.inc");
$template = new Template();

function getContent($template){

return "

<center>
<form method=POST action=signup.php>
<table width=50% >

<input type=hidden value=\"uf\" name=at>
<input type=hidden value=\"user\" name=0>
<input type=hidden value=\"\" name=cname>
<tr valign=top>
	<td><b>".$template->signupasuser_firstname."</b></td>
	<td>
	<input type=text name=fname value='' maxlength=32>
	</td>
	<td><b>".$template->signupasuser_lastname."</b></td>
	<td>
	<input type=text name=lname value='' maxlength=32>
	</td>
</tr>

<tr valign=top>
	<td><b>".$template->signupasuser_accounttype."</b></td>
	<td>
	<input type=radio name=mname value='Free' maxlength=32 checked>".$template->signupasuser_atfree."
</td><td>
	<input type=radio name=mname value='Premium' maxlength=32>".$template->signupasuser_atpremium."
(<a target=\"_new\" href='help/coupon_commando_premium_accounts.php'>?</a>)
	</td>
</tr>

<!--

Enable this in signup.php to enable custom username
<tr>
        <td>
        <b>Username</b>:
        </td>
        <td>
        <input type=text name=\"txtUsername\" value=\"\" maxlength=32>
        </td>
</tr>
-->

<tr>
        <td>
        <b>Password</b>:
        </td>
        <td>
        <input type=password name=\"txtPassword\" value=\"\" maxlength=32>
        </td>
</tr>


<tr>
        <td>
        <b>E-mail</b>:
        </td>
        <td>
        <input type=text name=\"txtEmail\" value=\"\">
        </td>
</tr>


<tr>
<td>
<input type=submit value='".$template->signupasuser_next."' style=\"background-image: url(".$GLOBALS['siteurl']."templates/base_template/images/nextbtnbg.jpg); 
background-repeat: no-repeat; border: 0; height: 26px; 
width: 58px; font: 11px Arial, Helvetica, sans-serif; font-weight: bold;color: #9a1904;\">
</td>
</tr>

</table>
</form>

";

} //end native getContent

$content = getContent($template);

$res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
echo $res;

?>
