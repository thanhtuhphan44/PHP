<?php
if(isset($_POST['txtPrice'])) {
	$price = $_POST['txtPrice'];
 
	// 2. Chuan bi cau truy van & 3. Thuc thi cau truy van
	$strSQL = "SELECT * FROM tbl_product where pd_price <= $price";
	$result = dbQuery($strSQL);
	// 4.Xu ly du lieu tra ve
	echo "<table cellspacing=0 cellpadding=0 border=1 width=600>";
	echo "<tr>";
		
		echo "<td> Name </td>";
		echo "<td> Price </td>";
		echo "<td> Image </td>";
	echo "</tr>";
	while ($row = dbFetchAssoc($result))
	{
		echo "<tr>";
		echo "<td>".$row['pd_name'] . "</td>";
		echo "<td>".$row['pd_price'] . "</td>";
		echo "<td><img src=images/product/".$row['pd_image']." /></td>";
		echo "</tr>";
	}
	echo "</table>";
	
}
?>