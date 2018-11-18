<?php
	//chama o arquivo de conexão com o bd
	include_once("../../../includes/conectar.php");
	$info = $_POST['subgroups'];

	$data = json_decode($info);
	$id = $data->id;
	$groupId=$data->groupId;
	$subGroupCode=$data->subGroupCode;
	$subGroupName=$data->subGroupName;
	$status = $data->status;
	
	//reading groupnamer
	$rs=$conn->query("select * from groups where id='".$groupId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$groupName=$r['groupName'];
	}
	//consulta sql
	$query = sprintf("UPDATE subgroup SET subGroupCode = '%s',subGroupName = '%s', status = '%d' WHERE id=%d",
		$conn->real_escape_string($subGroupCode),
		$conn->real_escape_string($subGroupName),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"subgroups" => array(
			"id" => $id,
			"sugGroupCode" => $subGroupCode,
			"sugGroupName" => $subGroupName,
			"status" => $status,
			"groupId"=>$groupId,
			"groupName"=>$groupName,
		)
	));
?>