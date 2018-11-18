<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['groups'];

	$data = json_decode($info);
	$id = $data->id;
	$groupCode=$data->groupCode;
	$groupName=$data->groupName;
	$natureId=$data->natureId;
	$status = $data->status;
	
	$rs=$conn->query("select * from acnature where id='".$natureId."'");
	$r=mysqli_fetch_assoc($rs);
	$nature=$r['nature'];

	//consulta sql
	$query = sprintf("UPDATE groups SET groupCode = '%s',groupName = '%s', natureId='%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($groupCode),
		$conn->real_escape_string($groupName),
		$conn->real_escape_string($natureId),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"groups" => array(
			"id" => $id,
			"groupCode"=>$groupCode,
			"groupName" => $groupName,
			"status" => $status,
			"natureId"=>$natureId,
			"nature"=>$nature
		)
	));
?>