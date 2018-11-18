<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['departmentss'];

	$data = json_decode($info);
	$id=$data->id;
	$department = $data->department;
	$dept_head_id=$data->dept_head_id;
	$status=$data->status;
	
	 // $department = $_REQUEST['department'];
	 // $dept_head_id = $_REQUEST['dept_head_id'];
	 // $status = $_REQUEST['status'];
	 //  $id = $_REQUEST['id'];
	 
	$sql="select * from staff where id='".$dept_head_id."'";
	$rs= $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$staffName=$r['staffName'];

	//consulta sql
	$query = sprintf("UPDATE department SET department = '%s',dept_head_id = '%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($department),
		$conn->real_escape_string($dept_head_id),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"dipartmentss" => array(
			"id" => $id,
			"department" => $department,
			"dept_head_id" => $dept_head_id,
			"status"=>$status,
			"staffName"=>$staffName,
			"q"=>$query
		)
	));
?>