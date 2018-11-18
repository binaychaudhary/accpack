<?php
	include_once("../conn.php");

	$info = $_POST['designation'];

	$data = json_decode(stripslashes($info));

	$designation = $data->designation;
	$status = $data->status;



	// $supplier_name = $_REQUEST['supplier_name'];
	// $supplier_head = $_REQUEST['supplier_head'];
	// $status = $_REQUEST['status'];
	//$email_address = $_REQUEST['email_address'];

	//consulta sql
	$query = sprintf("INSERT INTO design (designation,status) values ('%s', '%d')",
		$conn->real_escape_string($designation),
		$conn->real_escape_string($status));
	

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"designation" => array(
			"id" => mysqli_insert_id($conn),
			"designation" => $designation,
			"status" => $status,
			"query" => $query
		)
	));c
	
?>