<?php
	include("../../includes/conectar.php");

	$id=$_REQUEST['id'];
	$group_id=$_REQUEST['group_id'];
	$qty=$_REQUEST['qty'];
	$rate=$_REQUEST['rate'];
	$amount=$_REQUEST['amount'];
	$unit_id = $_REQUEST['unit_id'];

	$salesUnitId = $_REQUEST['salesUnitId'];
	$perUnit= $_REQUEST['perUnit'];
	$sales_rate = $_REQUEST['sales_rate'];


	$updateQry="update inv_item set rate = '$rate', sales_rate = '$sales_rate' where id = '$id'";
	$conn->query($updateQry);

	

?>