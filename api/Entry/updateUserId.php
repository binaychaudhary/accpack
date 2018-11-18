<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	
	$fiscalyear = $_REQUEST['fiscalyear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$user_id =$_REQUEST['user_id'];
	$entryNo=$_REQUEST['entryNo'];

	$sql="update entry set userId='$user_id' where fiscalyear='$fiscalyear' and sourceCodeId='$sourceCodeId' and entryNo='$entryNo'";
	$rs = $conn->query($sql);
	//	echo $sql;
	
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>