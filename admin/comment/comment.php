<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$sql = "SELECT *
        FROM tbl_comment
		ORDER BY user_name";
$result = dbQuery($sql);
?> 
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center"> 
   <td>comment id</td>
   <td width="120">user name</td>
   <td width="120">product id</td>
   <td width="120">content</td>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $comment_id; ?></td>
   <td width="120" align="center"><?php echo $user_name; ?></td>
   <td width="120" align="center"><?php echo $product_id; ?></td>
   <td width="120" align="center"><?php echo $content; ?></td>
  </tr>
<?php
} // end while

?>
</table>