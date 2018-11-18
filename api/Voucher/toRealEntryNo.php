<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$oldEntryNo=$_REQUEST['oldEntryNo'];
	$newEntryNo=$_REQUEST['newEntryNo'];
	$userId=$_REQUEST['userId'];
	$qry="update tmpentry set entryNo='".$newEntryNo."' where fiscalYear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$oldEntryNo."' and userId='".$userId."'";
	$conn->query($qry);
	
	$qry="insert into entry select * from tmpentry where  fiscalYear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$newEntryNo."'";
	$conn->query($qry);
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"newEntryNo"=>$newEntryNo
	));
?>