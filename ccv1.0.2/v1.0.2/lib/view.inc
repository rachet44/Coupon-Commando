<?php

class View
{

	var $data;
	var $mediator;

	function processTemplateInsert($templateHTML, $content) {
		 $temp=$templateHTML;

                $temp = str_replace("TEMPLATE_LOGIN", $this->getLoginFormHTML(), $temp);
                $temp = str_replace("STYLE_LINK",  $GLOBALS['siteurl']."templates/base_template/style.css",$temp);
                $temp = str_replace("IMG_HEADER",  $GLOBALS['siteurl']."templates/base_template/images/coupon_commando_logo.jpg",$temp);
                $temp = str_replace("HOME_LINK",  $GLOBALS['siteurl']."index.php",$temp);
                $temp = str_replace("COUPON_LINK",  $GLOBALS['siteurl']."index.php?coupons=1",$temp);
                $temp = str_replace("MERCHANT_LINK",  $GLOBALS['siteurl']."merchant/dashboard.php",$temp);

                $temp = str_replace("REGISTER_LINK_CLIENT",  $GLOBALS['siteurl']."signup_for_coupons.php",$temp);
                $temp = str_replace("REGISTER_LINK_MERCHANT",  $GLOBALS['siteurl']."signup_as_merchant.php",$temp);

		$temp = str_replace("MAIN_CONTENT_INSERT", $content,$temp);

		return $temp;


	} // end processTemplateInsert

	function processTemplate($templateHTML){
		$temp=$templateHTML;

                $temp = str_replace("TEMPLATE_LOGIN", $this->getLoginFormHTML(), $temp);
                $temp = str_replace("STYLE_LINK",  $GLOBALS['siteurl']."templates/base_template/style.css",$temp);
                $temp = str_replace("IMG_HEADER",  $GLOBALS['siteurl']."templates/base_template/images/coupon_commando_logo.jpg",$temp);
                $temp = str_replace("HOME_LINK",  $GLOBALS['siteurl']."index.php",$temp);
                $temp = str_replace("COUPON_LINK",  $GLOBALS['siteurl']."index.php?coupons=1",$temp);
                $temp = str_replace("MERCHANT_LINK",  $GLOBALS['siteurl']."merchant/dashboard.php",$temp);

                $temp = str_replace("REGISTER_LINK_CLIENT",  $GLOBALS['siteurl']."signup_for_coupons.php",$temp);
                $temp = str_replace("REGISTER_LINK_MERCHANT",  $GLOBALS['siteurl']."signup_as_merchant.php",$temp);

		return $temp;

	} // end processTemplate

	function getLoginFormHTML(){

	 return "<form method=POST action=\"".$GLOBALS['siteurl']."login.php\">
                <div>

                        <h3>Member Name:</h3>

                        <input name=uname type=\"text\" maxlength=32/>

            <h3>Password:</h3>

            <input type=\"password\" name=upass maxlength=32 />

                        <input type=\"submit\" value=\"Go\" class=\"button\" />

                </div></form>";

	} // end getLoginFormHTML

	function Initialize($data, $mediator){	
		$this->data = $data;
		$this->mediator = $mediator;
	}

	function doGeneratedCodeCheck(){
		//exit();
	}// end doGeneratedCodeCheck

	function getNextActionForGeneratedCode($val){
		echo($this->getOneTimeOffer($val));
	} // end getNextActionForGeneratedCode

	function getOneTimeOffer($val){

		if (!is_object($this->mediator)){
			include("mediator.inc");
			$this->mediator= new mediator();
		}
	

		if (!is_object($this->data)){
			if (!is_object($this->mediator))
				include("data.inc");
			$this->data = new Data();
			$this->mediator->data = $this->data;
		}

	$result = $this->data->DoQuery("select id from cc_coupons where codegenname='$val'");
	
	$id = $result[0]['id'];

	$offer = $this->mediator->getOneTimeOffer($id);	

	echo($offer);

	echo("<p><a href='../../couponview.php?s2=".md5($result[0]['id'])."'>No thanks, take me to the coupon</a>");
	} // end getOneTimeOffer


	function getHeader() {

	} // end getHeader

	function getFooter() {
		return "<hr><center><a href='rss.php'>Subscribe to this RSS Feed</a>. | <a href='logout.php'>Log out</a>";

	} // end getFooter

	function doContentTemplate($template, $content) {
		$temp = str_replace("MAIN_CONTENT_INSERT", $content, $template);
		echo $temp;
	}

	function getUnregisteredView($template){
				
		$temp = "You do not have an account. <a style=\"font-size:12pt;\" \"href=\"".$GLOBALS['siteurl']."signup_for_coupons.php"."\">Register today</a> to do more with these coupons!";

		$dataTable = $this->data->DoQuery("select * from cc_coupons order by ID desc");

		foreach($dataTable as $row){
			$temp.="<br><img width=50 height=50 src='".str_replace("../","./",$row['imgname'])."'>";
		}

		$this->doContentTemplate($template,$temp);
		
	} // end getUnregisteredView

	function getRegisteredView($template){

		$content.=$this->getHeader();

		$dataTable = $this->data->DoQuery("select * from cc_coupons order by ID desc");

		foreach($dataTable as $row){
			$content .="<br><img width=50 height=50 src='".str_replace("../","./",$row['imgname'])."' align=middle><li><a href='coupons/specials/".$row['codegenname']."'>Print this Coupon</a><p>";
		}
		
/*		$content .="
		<p>
		<li>Coupon listing would go here.</li>
		<a href='couponview.php?key=31415'>Coupon Details</a>
		";
*/

		$content.=$this->getFooter();

		return $content;
	} // end getRegisteredView()

} //end class View

?>
