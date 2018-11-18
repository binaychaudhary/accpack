<?php

	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];
	$printedBy=$_REQUEST['userId'];

	$sql ="update entry set printStatus='1', printedBy='".$printedBy."' where fiscalyear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."'";
	echo $sql;
	include("../../includes/conectar.php");
	$conn->query($sql);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>