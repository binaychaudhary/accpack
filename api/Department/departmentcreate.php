<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['departmentss'];

	$data = json_decode($info);
	
	$department = $data->department;
	$dept_head_id = $data->dept_head_id;
	$status=$data->status;

  //    $department = $_REQUEST['department'];
	 // $dept_head_id = $_REQUEST['dept_head_id'];
	 // $status = $_REQUEST['status'];

	$sql="select * from staff where id='".$dept_head_id."'";
	$rs= $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$staff_Name=$r['staffName'];
	//echo $staff_Name;
	//consulta sql

	$query = sprintf("INSERT INTO department (department,dept_head_id,status) values ('%s','%d','%d')",
		$conn->real_escape_string($department),
		$conn->real_escape_string($dept_head_id),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"dipartmentss" => array(
			"id" => mysqli_insert_id($conn),
			"department" => $department,
			"dept_head_id"=>$dept_head_id,
			"staffName"=>$staff_Name,
			"status"=>$status,
			"q"=>$query
		)
	));
?>