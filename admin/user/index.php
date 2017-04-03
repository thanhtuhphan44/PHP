<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Users';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Add Users';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Modify Users';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Users';
}

$script = array('user.js');

require_once '../include/template.php';
?>
