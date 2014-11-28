<?php

include("data.inc");
include("user.inc");

class Mediator {

	//local data service
	var $data;
	var $user;
	var $view;

	function CouponTrackCheck($id){
		$this->SessionCheck();

		$user_id = $_SESSION['token'];
		
		$sql = "select viewed from cc_tracking	where user_id=$user_id and coupon_id=$id";
		$result = $this->data->DoQuery($sql);

		if ($result[0]['viewed'] == 'Y'){
		echo("You have already printed this coupon and have no remaining credits.");
		exit();
		}		

	} // CouponTrackCheck

	function SetTracking($id){
		$this->SessionCheck();
                $user_id = $_SESSION['token'];

		$sql = "insert into cc_tracking (viewed, user_id, coupon_id) values ('Y',$user_id, $id)";
		$result = $this->data->DoQuery($sql);
	}// end SetTracking

	function getCoupon($id){
		$sql = "select * from cc_coupons where id=$id";
		return $this->data->DoQuery($sql);
	} // end getCoupon

	function getCouponList() {
		$sql = "select id from cc_coupons";
		return $this->data->DoQuery($sql);
	} // end getCouponList

	function useDisplayToken($id){
		if (!is_numeric($id))
			return;

		$sql = "update cc_onetimeoffers set displaytokens = displaytokens - 1 where id = $id";
		$this->data->DoQuery($sql);

	} // end useDisplayToken

	function createOneTimeOffer( $account_id, $coupon_id, $isglobal, $offer_name, $webhtml, $credits ) {

		$webhtml = addslashes($webhtml);
		$offer_name = addslashes($offer_name);

		if (!is_numeric($credits)){
			echo("Invalid data for credits.");
			exit();
		}

		$gp = "N";
		if ($isglobal == "on")
			$gp = "Y";

		if ($coupon_id == "")
			$coupon_id = -1;

		$sql = "insert into cc_onetimeoffers (user_id, coupon_id, global_placement, webhtml, displaytokens, active,name)
			values ($account_id,$coupon_id,'".$gp."','".$webhtml."',$credits,'Y','".$offer_name."')";

		$this->data->DoQuery($sql);

	} // end createOneTimeOffer


	function getOneTimeOffer($coupon_id) {

		$sql = "select webhtml, id from cc_onetimeoffers where (coupon_id = $coupon_id and displaytokens > 0) or (global_placement='Y' and displaytokens>0)";
		$result = $this->data->DoQuery($sql);

		if ($result[0] == "")
			return "There are no one time offers configured for viewing. Please set one up in the administrative panel.";

		if ($result[0]['webhtml'] == ""){
//			echo("no matches, try global");
			$sql = "select webhtml from cc_onetimeoffers where global_placement='Y' and displaytokens >0";
echo("0x4410");
			exit();
		} else {
			$this->useDisplayToken($result[0]['id']);			
			return $result[0]['webhtml'];
		}

	}

	function createCoupon($name, $imglocation, $codegenname) {

		$this->SessionCheck();

		$user_id 	= $_SESSION['token'];
		$name 		= addslashes($name);
		$imgname	= $imglocation;
		$codegenname	= $codegenname;

		$sql = "INSERT INTO cc_coupons (user_id, name, imgname,codegenname) VALUES ($user_id,'$name','$imgname','$codegenname')";

		$this->data->DoQuery($sql);

	} //end createCoupon

	function checkUsernameExists($user) {
		$user = addslashes($user);
		$sql = "SELECT id from cc_users where user = '$user'";

		$result = $this->data->DoQuery($sql);

		if ($result[0]['id'] != "")
			return true;

		return false;
		
	} // checkUsernameExists

	function createUser($fname, $lname, $account_type, $cname,$email, $user,$pass) {

		$user = addslashes($user);
		$pass = addslashes($pass);

		$username = $this->data->generateStrongWords();
		$password = $this->data->generateStrongWords(12);

		if ($user != "")
			$username = $user;

		if ($pass != "")
			$password = $pass;		

		$fname = addslashes($fname);
		$lname = addslashes($lname);
		$cname = addslashes($cname);
		$account_type = addslashes($account_type);

		$sql = "INSERT INTO cc_users (user, pass, account_type, first_name, last_name, company_name, email) VALUES ('$username',password('$password'),'$account_type','$fname','$lname','$cname','$email')";
		$this->data->DoQuery($sql);
	
		$res = "This is your coupon-commando username and password. Please store them in a safe place.";
		$res .="<li>Username:".$username;
		$res .="<li>Password:".$password;

		return $res;

	} // end createUser

	function Initialize($view) {
		$this->data = new data();
		$this->user = new user();
		$this->view = $view;

	} //end Initialize

	function doLogin($user, $pass) {
	
		$user =addslashes($user);
		$pass =addslashes($pass);

		$result = $this->data->DoQuery("select id from cc_users where user = '$user' and pass=password('$pass')");
//print_r($result[0]['id'].":".$user.":".$pass);
		if ($result[0]['id'] != 0){
			session_start();
			$_SESSION['token']=$result[0]['id'];
			return true;
		}

		return false;
	} //end doLogin

	function SessionCheck(){
		session_start();

		if (!isset($_SESSION['token'])){
			echo("<a href='login.php'>Please login</a>");
			exit();
		}
	} //end SessionCheck

	
        function SessionCheckBool(){
                session_start();

                if ($_SESSION['token']>0){
			return true;
                }
		return false;
        } //end SessionCheck

	function IsMerchantRole() {
		$this->SessionCheck();

		$sql = "select account_type from cc_users where id=".$_SESSION['token'];
		$result = $this->data->DoQuery($sql);

		if ($result[0]['account_type']=="m")
			return true;

		return false;		
	} //end isMerchantRole

	function GetAllUsers() {
		$sql = "select * from cc_users order by account_type";
		$result = $this->data->DoQuery($sql);
		return $result;
	} //end GetAllUsers()

	function GetAllCoupons() {
                $sql = "select * from cc_coupons order by name";
                $result = $this->data->DoQuery($sql);
                return $result;
	} //end GetAllCoupons


	function GetAllOneTimeOffers() {
  	        $sql = "select * from cc_onetimeoffers order by name";
                $result = $this->data->DoQuery($sql);
                return $result;

	} //end GetAllOneTimeOffers

}

?>
