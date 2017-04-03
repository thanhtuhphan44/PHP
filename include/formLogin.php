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
		$sql = "SELECT cus_id
		        FROM tbl_customer
				WHERE cus_name = '$u' AND cus_password = OLD_PASSWORD('$p')";
		$result = dbQuery($sql);
	
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			$_SESSION['plaincart_cus_id'] = $row['cus_id'];
			$_SESSION['cus_name'] = $u;
			// log the time when the user last login
			$sql = "UPDATE tbl_customer
			        SET cus_last_login = NOW() 
					WHERE cus_id = '{$row['cus_id']}'";
			dbQuery($sql);

			// now that the user is verified we move on to the next page
            // if the user had been in the admin pages before we move to
			// the last page visited
			if (isset($_SESSION['login_return_url'])) {
				header('Location: '.$_SESSION['login_return_url']);
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

<fieldset class="fieldset">
	<legend class="legend">:: LOGIN (^_^) ::</legend>
		<form method="post" action="index.php?action=login" class="form">
			<p>&nbsp;</p>
		<table>
		<tr>
			<td colspan="3"><center><i><span style="color:red"><?php echo $errorMessage; ?></span></i></center></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="100" align="right"><b>UserName</b></td>
			<td width="20" align="center">:</td>
			<td><input name="txtUserName" type="text" size="20"></td>
 		</tr>
 		<tr> 
 			<td width="100" align="right"><b>PassWord</b></td>
 			<td width="20" align="center">:</td>
			<td><input name="txtPassWord" type="password" size="20"></td>
		</tr>
 		<tr> 
 			<td colspan="2">&nbsp;</td>
			<td><input type="submit" value="Login"></td>
		</tr>
	</table>
	<p>&nbsp;</p>
</form>
</fieldset>