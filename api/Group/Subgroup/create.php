<?php
	//chama o arquivo de conexão com o bd
	include("../../../includes/conectar.php");

	$info = $_POST['subgroups'];

	$data = json_decode($info);
	$groupId=$data->groupId;
	$subGroupCode = $data->subGroupCode;
	$subGroupName = $data->subGroupName;
	$status = $data->status;
	//reading groupName
	$rs=$conn->query("select * from groups where id='".$groupId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$groupName=$r['groupName'];
	}
	
	//consulta sql
	$query = sprintf("INSERT INTO subgroup (subGroupCode,subGroupName,status,groupId) values ('%s','%s','%d','%d')",
		$conn->real_escape_string($subGroupCode),
		$conn->real_escape_string($subGroupName),
		$conn->real_escape_string($status),
		$conn->real_escape_string($groupId)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"subgroups" => array(
			"id" => mysqli_insert_id($conn),
			"subGroupCode" => $subGroupCode,
			"subGroupName" => $subGroupName,
			"status" => $status,
			"groupId"=>$groupId,
			"groupName"=>$groupName
		)
	));
?>