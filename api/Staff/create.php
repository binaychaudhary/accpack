<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['staffs'];

	$data = json_decode($info);
	
	$staffName = $data->staffName;
	$address = $data->address;
	$mobileNo=$data->mobileNo;
	$email=$data->email;
	$designationId=$data->designationId;
	$status=$data->status;
	

	$rs=$conn->query("select * from designation where id='".$designationId."'");
	$r=mysqli_fetch_assoc($rs);
	$designation=$r['designation'];

	//consulta sql
	$query = sprintf("INSERT INTO staff (staffName,address,mobileNo, email,status, designationId) values ('%s','%s','%s','%s','%d','%d')",
		$conn->real_escape_string($staffName),
		$conn->real_escape_string($address),
		$conn->real_escape_string($mobileNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($status),
		$conn->real_escape_string($designationId)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"staffs" => array(
			"id" => mysqli_insert_id($conn),
			"staffName" => $staffName,
			"address" => $address,
			"email"=>$email,
			"status"=>$status,
			"designationId"=>$designationId,
			"designation"=>$designation
		)
	));
?>