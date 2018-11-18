<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['groups'];

	$data = json_decode($info);
	$groupCode=$data->groupCode;
	$groupName = $data->groupName;
	$natureId=$data->natureId;
	$status = $data->status;

	$rs=$conn->query("select * from acnature where id='".$natureId."'");
	$r=mysqli_fetch_assoc($rs);
	$nature=$r['nature'];

	//consulta sql
	$query = sprintf("INSERT INTO groups (groupCode, groupName, natureId, status) values ('%s','%s','%d','%d')",
		$conn->real_escape_string($groupCode),
		$conn->real_escape_string($groupName),
		$conn->real_escape_string($natureId),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"groups" => array(
			"id" => mysqli_insert_id($conn),
			"groupCode"=>$groupCode,
			"groupName" => $groupName,
			"status" => $status,
			"natureId"=>$natureId,
			"nature"=>$nature
		)
	));
?>