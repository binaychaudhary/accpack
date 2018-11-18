<?php

	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];
	$approvedBy=$_REQUEST['userId'];
	$approvedDate =$_REQUEST['approvedDate'];

	$sql ="update entry set approvalStatus='1', approvedBy='".$approvedBy."', approvedDate ='".$approvedDate."' where fiscalyear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."'";
	echo $sql;
	include("../../includes/conectar.php");
	$conn->query($sql);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sql"=>$sql
	));
?>