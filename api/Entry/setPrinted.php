<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	
	$fiscalyear = $_REQUEST['fiscalyear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo =$_REQUEST['entryNo'];
	$sql=sprintf("update entry set printStatus='%d' where fiscalyear='%s' and sourceCodeId='%d' and entryNo='%s'",
		1,
		$conn->real_escape_string($fiscalyear),
		$conn->real_escape_string($sourceCodeId),
		$conn->real_escape_string($entryNo)
		);
	
	$rs = $conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>