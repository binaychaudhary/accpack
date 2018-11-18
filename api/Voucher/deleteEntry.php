<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");


	$fiscalYear=$_REQUEST['fiscalYear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];
	

	//consulta sql
	$query = "DELETE FROM tmpentry WHERE fiscalyear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."'";
	$rs = $conn->query($query);


	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>