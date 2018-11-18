<?php
	$tranDateBs=$_REQUEST['tranDateBs'];
	$closedAt =  date("Y-m-d H:i:s");
	include("../../includes/conectar.php");
	$sql = "update transactiondate set closed='1', closedAt ='".$closedAt."' where tranDateBs='".$tranDateBs."'";
	$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>