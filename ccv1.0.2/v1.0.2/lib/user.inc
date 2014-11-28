<?php

class User {
	var $id;
	var $username;
	var $email;
	var $firstname;
	var $lastname;

	//this will need swapped out with a session component
	function IsLoggedIn(){

		if ($this->id ==0)
		return false;

		return true;
	}
}

?>