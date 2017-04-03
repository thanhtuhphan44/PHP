
<?php

	$return = '&nbsp;';
	$return2 = '&nbsp;';
	if(isset($_POST['txtName']) && isset($_POST['txtPassword']))
	{
		$name=$_POST['txtName'];
		$password=$_POST['txtPassword'];

		if ($name == '') {
			$return = 'Please fill in the Name.';
		} else if ($password == '') {
			$return = 'Please fill in the Password.';
		} else {
			$sql = "SELECT cus_id
				    FROM tbl_customer
					WHERE cus_name = '$name'";
			$result1 = dbQuery($sql);
			if (dbNumRows($result1) == 0) {
				$strSQL = "INSERT INTO tbl_customer(cus_name, cus_password, cus_regdate) 
							VALUES('$name', OLD_PASSWORD('$password'), NOW())";
				@$result = dbQuery($strSQL);
				if($result) {
					$return2 = "<a href='index.php?action=login'>Go to the Login page</a>";
					$return = 'You have successfully registered!';
				}
			} else {
				 $return = "Account already exists!";
			}
		}
	}
?>

<fieldset class="fieldset">
	<legend class="legend">:: REGISTER ::</legend>
	<form action="index.php?action=register" method="post" class="form">
		<table>
		<tr>
			<td colspan="2" class="label"><center><i><span style="color:red"><?php echo $return."<br/>".$return2 ; ?></span></i></center></td>
		</tr>
		<tr>
			<td> <input type="hidden" name="txtId" /> </td>
		</tr>
		<tr>
			<td>UserName : </td>
			<td> <input type="text" name="txtName" /> </td>
		</tr>
		<tr>
			<td>PassWord : </td>
			<td> <input type="password" name="txtPassword" /> </td>				
		</tr>
		<tr>
			<td colspan="2"> <center><input type="submit" value="Register" /> </center></td>
		</tr>
		</table>
	</form>
	</fieldset>