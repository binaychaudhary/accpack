<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['rinsamitis'];

	$data = json_decode($info);

	$name = $data->name;
	$positionId=$data->positionId;
	$address=$data->address;
	$mobileNo=$data->mobileNo;
	$emailAddress=$data->emailAddress;
	$workingPeriod=$data->workingPeriod;
	$status = $data->status;

	$rs=$conn->query("select * from credit_post where id='".$positionId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$position=$r['position'];
	}
	//consulta sql
	$query = sprintf("INSERT INTO rinsamiti (name, positionId, address, mobileNo, emailAddress, workingPeriod, status) values ('%s','%d','%s','%s','%s','%s','%d')",
		$conn->real_escape_string($name),
		$conn->real_escape_string($positionId),
		$conn->real_escape_string($address),
		$conn->real_escape_string($mobileNo),
		$conn->real_escape_string($emailAddress),
		$conn->real_escape_string($workingPeriod),
		$conn->real_escape_string($status)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"rinsamitis" => array(
			"id" => mysqli_insert_id($conn),
			"name" => $name,
			"positionId"=>$positionId,
			"address" => $address,
			"mobileNo" => $mobileNo,
			"emailAddress" => $emailAddress,
			"workingPeriod" => $workingPeriod,
			"status" => $status,
			"position"=>$position
		)
	));
?>