<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	
	$arival_id = $_REQUEST['arival_id'];
	
	$sql="update arrival set arrival_status='1' where id='$arival_id'";
	$rs = $conn->query($sql);
	//	echo $sql;
	
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sql" =>$sql
	));
?>