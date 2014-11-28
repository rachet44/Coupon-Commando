<?php
include("globals.php");

class data {

	var $dbhost = "";
	var $dbuser = "";
	var $dbpass = "";
	var $db = "";

	function SetVars() {

		$this->dbhost = $GLOBALS['dbhost'];
	        $this->dbuser = $GLOBALS['dbuser'];
        	$this->dbpass = $GLOBALS['dbpass'];
	        $this->db = $GLOBALS['db'];

	} //end SetVars

	function generateStrongWords ($length = 8)
	{

	  // start with a blank password
	  $password = "";

	  // define possible characters
	  $possible = "0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
    
	  // set up a counter
	  $i = 0; 
    
	  // add random characters to $password until $length is reached
	  while ($i < $length) { 

	    // pick a random character from the possible ones
	    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
	    // we don't want this character if it's already in the password
	    if (!strstr($password, $char)) { 
      	$password .= $char;
      	$i++;
    	}

	  }

	  // done!
	  return $password;

	} // end generateStrongWords


	function create_seo_php ($title_name,$unsafe,$template) {

		$fh = fopen($template, 'r');
		$theData = fread($fh, filesize($template));
		fclose($fh);

		$theData = str_replace("UNIQUE_KEY_CONSTRAINT", "\"".$title_name."\"", $theData);

		//echo "<xmp>".$theData."</xmp>";

		$myFile = "../coupons/specials/$title_name.php";
		$fh = fopen($myFile, 'w') or die("The webserver is unable to write file. Do you have the permissions set correctly for the specials directory (coupons/specials)? There may also exist a file in the directory that is protected with this name. Try a different title.");
		fwrite($fh, $theData);
		fclose($fh);

		echo ("Wrote SEO page: <a href='../coupons/specials/$title_name.php'>$unsafe</a>");

		chmod($myFile, 0777);

		return $title_name;
	} // end create_seo_php


	function removeUnsafeAttributesAndGivenTags($input, $validTags = '')
	{
	    $regex = '#\s*<(/?\w+)\s+(?:on\w+\s*=\s*(["\'\s])?.+?\(\1?.+?\1?\);?\1?|style=["\'].+?["\'])\s*>#is';
	    return preg_replace($regex, '<${1}>',strip_tags($input, $validTags));
	} // end removeUnsafeAttributesAndGivenTags 
	

	function DoQuery($sql) {

		$this->SetVars();

		$link = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass);

		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}

		mysql_select_db($this->db, $link) or die('Could not select database.');

		$result = mysql_query($sql);
		if (!$result) {
		    die('Could not query:' . mysql_error());
		}


		//datatable [Row Number] [ Key ] -> value

		$dataTable = Array();
		$i=0;
		while($row = mysql_fetch_array($result)) {

			foreach($row as $k=>$v){
				$dataTable[$i][$k]=$v;				
			}
			$i++;
		}


	//	mysql_free_result($result);
		mysql_close($link);

		return $dataTable;
	
	} //end function DoQuery
}

?>
