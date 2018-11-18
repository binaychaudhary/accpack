<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['sanchalaksamitis'];

	$data = json_decode($info);
	$id = $data->id;
	$name=$data->name;
	$positionId=$data->positionId;
	$address=$data->address;
	$mobileNo=$data->mobileNo;
	$emailAddress=$data->emailAddress;
	$workingPeriod=$data->workingPeriod;
	$status = $data->status;
	

	$rs=$conn->query("select * from sanchalak where id='".$positionId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$position=$r['position'];
	}
	//consulta sql
	$query = sprintf("UPDATE sanchalaksamiti SET name = '%s', positionId='%d', address = '%s', mobileNo = '%s', emailAddress = '%s', workingPeriod = '%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($name),
		$conn->real_escape_string($positionId),
		$conn->real_escape_string($address),
		$conn->real_escape_string($mobileNo),
		$conn->real_escape_string($emailAddress),
		$conn->real_escape_string($workingPeriod),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sanchalaksamitis" => array(
			"id" => $id,
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