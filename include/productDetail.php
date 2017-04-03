<?php

if (!defined('WEB_ROOT')) {
	exit;
}
$product = getProductDetail($pdId, $catId);
// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url
extract($product);
?> 
<table width="100%" border="0" cellspacing="0" cellpadding="10">
 <tr> 
  <td align="center"><img src="<?php echo $pd_image; ?>" border="0" alt="<?php echo $pd_name; ?>"></td>
  <td valign="middle">
	<strong><?php echo $pd_name; ?></strong><br>
	Price : <?php echo displayAmount($pd_price); ?><br>
	<?php
	// if we still have this product in stock
	// show the 'Add to cart' button
	if ($pd_qty > 0) {
		if (!isset($_SESSION['plaincart_cus_id']))
		{
			header("Location: index.php?action=login");
		}
	?>
	<input type="button" name="btnAddToCart" value="Add To Cart &gt;" onClick="window.location.href='<?php echo $cart_url; ?>';" class="addToCartButton" >
	<?php
	} else {
		echo 'Out Of Stock';
	}
	?>
  </td>
 </tr>
 <tr align="left"> 
  <td colspan="2"><?php echo $pd_description; ?></td>
 </tr>
</table>
	<fieldset class="fieldset">
		<legend class="legend">All Comments</legend>

<?php
	if(strcmp($action, "processComment") == 0) {
		if(isset($_POST['txtContent']))
		{
			$username=$_SESSION['cus_name'];
			$productid=$pdId; // $_POST['txtProductId'];
			$content=$_POST['txtContent'];

			$strSQL = "INSERT INTO tbl_comment(user_name, product_id, content) values ('$username', $productid, '$content')";

			$result = dbQuery($strSQL);
		}
	}

	$strSQL = "SELECT user_name, content FROM tbl_comment where product_id = $pdId";
	$result = dbQuery($strSQL);
	while($row = dbFetchArray($result)) {
		echo "<label class=\"label\"><span style=\"color: blue\">" . $row[0] . "</span>: <i>" . $row[1] . "</i></label>";
	}
?>
<table>
	<tr>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'].'&action=processComment'; ?> ">
		<td><center><textarea name="txtContent" cols="50" rows="5" autofocus placeholder="Post a comment..."></textarea></center></td><br/>
	</tr>
	<tr>
		<td><center><input type="submit" value="Comment" /></center><br/></td>
		</form>
	</tr>
</table>
</fieldset>