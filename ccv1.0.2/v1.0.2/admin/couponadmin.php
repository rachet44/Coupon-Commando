<?php

        include("setup_header.php");

//\	print_r($_POST);

	switch($_POST['btnAction']){
		case "Delete Selected":

			foreach($_POST['cbCoupon'] as $item){
			echo("<li>Deleted:".$item);
				$mediator->data->DoQuery("delete from cc_coupons where id=".$item);
			}
			break;
	}
?>


<a href="setup_couponmanagement.php">Return to maintenance</a>


