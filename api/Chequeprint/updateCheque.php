<?php
	include_once("../../includes/conectar.php");
	$chequeNo= $_REQUEST['chequeNo'];
	$receivedBy= $_REQUEST['receivedBy'];
	$receivedDateBs= $_REQUEST['receivedDateBs'];
	$receivedDateAd= $_REQUEST['receivedDateAd'];
	$fiscalYear= $_REQUEST['fiscalYear'];
	$sourceCodeId= $_REQUEST['sourceCodeId'];
	$entryNo= $_REQUEST['entryNo'];
	$amount= $_REQUEST['amount'];

	$sql="update chequeissued set receivedBy='$receivedBy', receivedDateBs='$receivedDateBs', receivedDateAd = '$receivedDateAd', fiscalYear='$fiscalYear', sourceCodeId='$sourceCodeId', entryNo='$entryNo', amount='$amount', status='1' where chequeNo='$chequeNo'";
	$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>