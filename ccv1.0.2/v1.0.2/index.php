<?php
session_start() or die ("Cookies must be enabled.");

include("./lib/view.inc");
include("./lib/mediator.inc");

//include("header.inc");

$view = new view();

$mediator = new Mediator();
$mediator->Initialize($view);

$view->Initialize($mediator->data, $mediator);

$template = "./templates/base_template/index.htm";
$templatecontent = "./templates/base_template/contentonly.htm";

if ($_GET['coupons'] == ""){

 if ($_GET['k'] == "") {

$res = $view->processTemplate(file_get_contents($template));
echo $res;
}else{
 $content = "<h1>".$_GET['k']."</h1>";
                $res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
                echo $res;

 }

}else{

	if (!$mediator->SessionCheckBool()) {

		if ($_GET['k'] == "") {
			$view->getunregisteredView($view->processTemplate(file_get_contents($templatecontent)) );
		}else{

		$content = "<h1>".$_GET['k']."</h1>";
                $res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
                echo $res;

		}
	}else {
		$content = $view->getRegisteredView($templatecontent);
		$res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
		echo $res;
	}

}
?>
