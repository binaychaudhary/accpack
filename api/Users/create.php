<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['users'];

	$data = json_decode($info);

	$userName = $data->userName;
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
	$query = sprintf("INSERT INTO user (userName, address, mobileNo, email, roleId, status) values ('%s','%s','%s','%s','%d','%d')",
		$conn->real_escape_string($userName),
		$conn->real_escape_string($address),
		$conn->real_escape_string($mobileNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($roleId),
		$conn->real_escape_string($status)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_errno() == 0,
		"users" => array(
			"id" => mysqli_insert_id($conn),
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