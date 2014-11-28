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

$content = "";

//send mail function to notify the user
function sendMail($sender_name, $sender_email, $to, $body, $subject) {

        $Name = $sender_name;           //senders name
        $email = $sender_email;         //senders e-mail adress

        $recipient = @to;       //recipient
        $header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields

        ini_set('sendmail_from', $sender_email); //Suggested by "Some Guy"

        mail($recipient, $subject, $body, $header); //mail command :)

} // end sendMail


if (!isset($_POST['at']))
{
	echo("Invalid Signup ... please try again!");
	exit();
}

$boolExists = $mediator->checkUsernameExists($_POST['txtUsername']);

if ($boolExists){
	echo("That username is already in use. Please select another.");
	exit();
}

if ($_POST['user']=='1'){
$content.="<br><a href='merchant/login.php' target='_new'>To Dashboard Login for Merchants</a> ";
}else{
	$content.="<br><a href='index.php'>View Coupons</a>";
}

$content.="<p><p><hr>";

$email = $_POST['txtEmail'];
//$user = $_POST['txtUsername'];
$user = $_POST['txtEmail'];
$pass = $_POST['txtPassword'];

$content .= $mediator->createUser($_POST['fname'], $_POST['lname'], $_POST['at'],$_POST['cname'], $email, $user, $pass);

$res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
echo $res;


//uncomment the line below to send mail
//sendMail("my name","sendfrom@thisemail.com","sendto@thisemail.com","thesubjectline","the body");	

?>
