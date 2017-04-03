
<?php
	//require_once 'library/cart-functions.php';
	
	if (isset($_SESSION['plaincart_cus_id'])) {
			unset($_SESSION['plaincart_cus_id']);

	//		deleteFromCart();
			//session_unregister('plaincart_cus_id');
		header('Location: index.php?action=login');
		exit;
	}
?>
