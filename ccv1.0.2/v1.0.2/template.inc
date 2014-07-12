<?php

	//format is pagename_element for public variables
	//using a template class to anticipate a more robust Template system
	//down the line.

class Template {

	//the signup as merchant page

	var $signupasmerchant_companyname = "Company Name";
	var $signupasmerchant_firstname = "First Name";
	var $signupasmerchant_lastname = "Last Name";

	var $signupasmerchant_accounttype = "Account Type";
	var $signupasmerchant_atfree = "Free";
	var $signupasmerchant_atpremium = "Premium";

	var $signupasmerchant_next = "Next >>";

	//the signup as user page
	var $signupasuser_companyname = "Company Name";
	var $signupasuser_firstname = "First Name";
	var $signupasuser_lastname = "Last Name";

	var $signupasuser_accounttype = "Account Type";
	var $signupasuser_atfree = "Free";
	var $signupasuser_atpremium = "Premium";

	var $signupasuser_next = "Next >>";


	//the login.php page

	var $login_username = "Username";
	var $login_password = "Password";
	var $login_submit = "Login >>";
	var $login_toptext = "Please enter your username and password to continue.";

}

?>
