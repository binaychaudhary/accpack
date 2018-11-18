<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['orgs'];

	$data = json_decode($info);
	
	$orgName = $data->orgName;
	$address = $data->address;
	$telephoneNo=$data->telephoneNo;
	$email=$data->email;
	$regdNo=$data->regdNo;
	$title = $data->title;
	
	//consulta sql
	$query = sprintf("INSERT INTO org (orgName, address, telephoneNo, email, regdNo,title) values ('%s','%s','%s','%s','%s','%s')",
		$conn->real_escape_string($orgName),
		$conn->real_escape_string($address),
		$conn->real_escape_string($telephoneNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($regdNo),
		$conn->real_escape_string($title)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"orgs" => array(
			"id" => mysqli_insert_id($conn),
			"orgName" => $orgName,
			"address" => $address,
			"telephoneNo"=>$telephoneNo,
			"email"=>$email,
			"regdNo"=>$regdNo,
			"title" =$title
		)
	));
?>