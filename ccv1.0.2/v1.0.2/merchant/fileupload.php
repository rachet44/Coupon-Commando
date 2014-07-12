<?php

include("../lib/view.inc");
include("../lib/mediator.inc");
$view = new View();

$mediator = new Mediator();
$mediator->Initialize($view);
$mediator->SessionCheck();

if (!$mediator->IsMerchantRole()){
        echo("Invalid role.");
        exit();
}

if ($_POST['MAX_FILE_SIZE'] == "100000"){

$arr = array(" ","`","'","!","@","#","$","%","^","&","*","(","0","-","+","\"",";",":","<",">","/","?","\\","|");

$codegenname = $mediator->data->create_seo_php(str_replace($arr,"_",$_POST['adname']),$_POST['adname'], "./generated_file_template.tpl");

	// Where the file is going to be placed 
	$target_path = "../coupons/images/";

/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{
    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded: <img src='$target_path'>";

} else{
    echo "There was an error uploading the file, please try again! Admin: do you have the directory permissions set correctly? coupons/images must be writable.";
}


$mediator->createCoupon($_POST['adname'], $target_path, $codegenname);

}//endif MAX_FILE_SIZE


function getContent() {

return "
<h3>The image must be in JPEG format for watermarking</h3>.

<form enctype=\"multipart/form-data\" action=\"fileupload.php\"  method=\"POST\">
Coupon name (will be used for SEO): <input type=text name=adname value=\"\" maxlength=32>
<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000\" />
Choose a file to upload: <input name=\"uploadedfile\" type=\"file\" /><br />
<input type=\"submit\" value=\"Upload File\" />
</form>";

} // end getContent

$templatecontent = "../templates/base_template/contentonly.htm";
$content = getContent();
$res = $view->processTemplateInsert(file_get_contents($templatecontent), $content);
echo $res;


?>
