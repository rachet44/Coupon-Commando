<?php

        include("setup_header.php");

	switch($_POST['btnAction']){
		case "Delete Selected":

			foreach($_POST['cbOneTimeOffers'] as $item){
				$mediator->data->DoQuery("delete from cc_onetimeoffers where id=".$item);
			}
			echo("Offers deleted.");
			break;
		case "Edit Selected":
			foreach($_POST['cbOneTimeOffers'] as $item){
			header("location:setup_onetimeoffer_add.php?id=".$item);
			}
		break;
	}


	if ($_POST['btnAction'] == ""){

	if (is_numeric($_POST['updateid'])){
		$mediator->data->DoQuery("delete from cc_onetimeoffers where id=".$_POST['updateid']);
	}

	$mediator->createOneTimeOffer($_POST['maccount'],$_POST['cbCoupon'],$_POST['cbGlobal'], $_POST['offer_name'], $_POST['WEBHTML'], $_POST['CREDITS']);

	}
?>



<a href="setup_onetimeoffer.php">Return to maintenance</a>


