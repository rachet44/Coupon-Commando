<?php

	//PAYPAL is not supported in this version.
        //IPN Payment Gateway information
        //receiver email is the email for the account receiving payment
        $GLOBALS['paypal_receiver_email'] = "seller@who.com";

	//According to the IPN manual, the "mc_currency" variable may contain the following currency codes: "USD", "GBP", "EUR", "CAD" and "JPY".
        $GLOBALS['paypal_mc_currency'] = "USD";

	//This is the cost per one credit
        $GLOBALS['paypal_mc_gross'] = "10.00";

        $GLOBALS['dbhost'] = "localhost";	//host for the mysql install
        $GLOBALS['dbuser'] = "mydbuser";		//username
        $GLOBALS['dbpass'] = "mydbpass";		//password
	$GLOBALS['db'] = "mydbname";		//db to use

	$GLOBALS['siteurl'] = "http://www.yourdomain.com/";	//include trailing slash, do not specify any php or html file
?>
