<?php

        include("setup_header.php");

	switch($_POST['btnAction']){
		case "Delete Selected":

			foreach($_POST['cbUser'] as $item){
				$mediator->data->DoQuery("delete from cc_users where id=".$item);
			}
			echo("Members deleted.");
			break;
	}
?>


<a href="setup_members.php">Return to maintenance</a>


