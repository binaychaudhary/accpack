<?php
	$fiscalYear = $_REQUEST['fiscalYear'];
	$tranDateBs=$_REQUEST['tranDateBs'];
	$tranDateAd=$_REQUEST['tranDateAd'];
	$startedAt =  date("Y-m-d H:i:s");
	include("../../includes/conectar.php");
	$sql = "insert into transactiondate (fiscalYear, tranDateBs, tranDateAd, started, startedAt) values('".$fiscalYear."','".$tranDateBs."','".$tranDateAd."',true,'".$startedAt."')";
	$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>