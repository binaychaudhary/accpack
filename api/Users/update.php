<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
$conn->query("SET NAMES utf8");  
	$info = $_POST['users'];

	$data = json_decode($info);
	$id = $data->id;
	$userName=$data->userName;
	$address=$data->address;
	$mobileNo=$data->mobileNo;
	$email=$data->email;
	$roleId=$data->roleId;
	$status = $data->status;
	

	$rs=$conn->query("select * from role where id='".$roleId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$role=$r['role'];
	}
	//consulta sql
	$query = sprintf("UPDATE user SET userName = '%s', address = '%s', mobileNo = '%s', email = '%s', roleId = '%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($userName),
		$conn->real_escape_string($address),
		$conn->real_escape_string($mobileNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($roleId),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"users" => array(
			"id" => $id,
			"userName" => $userName,
			"address" => $address,
			"mobileNo" => $mobileNo,
			"email" => $email,
			"roleId" => $roleId,
			"status" => $status,
			"role"=>$role
		)
	));
?>