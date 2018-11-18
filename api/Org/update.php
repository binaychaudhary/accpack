<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['orgs'];

	$data = json_decode($info);
	$id=$data->id;
	$orgName = $data->orgName;
	$address = $data->address;
	$telephoneNo=$data->telephoneNo;
	$email=$data->email;
	$regdNo=$data->regdNo;
	$title=$data->title;
	
	
	//consulta sql
	$query = sprintf("UPDATE org SET orgName = '%s', address = '%s', telephoneNo='%s', email='%s', regdNo='%s', title='%s' WHERE id=%d",
		$conn->real_escape_string($orgName),
		$conn->real_escape_string($address),
		$conn->real_escape_string($telephoneNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($regdNo),
		$conn->real_escape_string($title),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"fiscalyears" => array(
			"id" => $id,
			"orgName" => $orgName,
			"address" => $address,
			"telephoneNo"=>$telephoneNo,
			"email"=>$email,
			"regdNo"=>$regdNo,
			"title"=>$title
		)
	));
?>