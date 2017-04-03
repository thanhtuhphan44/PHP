<?php

	$errorMessage = '&nbsp;';

	if(isset($_POST['txtUserName']) && isset($_POST['txtPassWord']))
	{
		$u=$_POST['txtUserName'];
		$p=$_POST['txtPassWord'];


		if ($u == '') {
			$errorMessage = 'You must enter your username';
		} else if ($p == '') {
			$errorMessage = 'You must enter the password';
		} else {
		// check the database and see if the username and password combo do match
		$sql = "SELECT user_id
		        FROM tbl_user 
				WHERE user_name = '$u' AND user_password = md5('$p')";
		$result = dbQuery($sql);
	
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			$_SESSION['plaincart_user_id'] = $row['user_id'];
			
			// log the time when the user last login
			$sql = "UPDATE tbl_user 
			        SET user_last_login = NOW() 
					WHERE user_id = '{$row['user_id']}'";
			dbQuery($sql);

			// now that the user is verified we move on to the next page
            // if the user had been in the admin pages before we move to
			// the last page visited
			if (isset($_SESSION['login_return_url'])) {
				header('Location: ' . $_SESSION['login_return_url']);
				exit;
			} else {
				header('Location: index.php');
				exit;
			}
		} else {
			$errorMessage = 'Wrong username or password';
		}			
	}
}
?>
