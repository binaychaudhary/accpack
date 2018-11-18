<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$collector_id=$_REQUEST['collector_id'];
	$month_id=$_REQUEST['month_id'];
	$sub_group_code=$_REQUEST['sub_group_code'];
	$amount = $_REQUEST['amount'];
	$comm_rate = $_REQUEST['comm_rate'];
	$comm_amount = $_REQUEST['comm_amount'];
	
	
	//consulta sql
	$query = sprintf("INSERT INTO collector_commission (collector_id, month_id, sub_group_code, amount, comm_rate, comm_amount) values ('%d','%d','%s','%s','%s','%s')",
		$conn->real_escape_string($collector_id),
		$conn->real_escape_string($month_id),
		$conn->real_escape_string($sub_group_code),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($comm_rate),
		$conn->real_escape_string($comm_amount)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"commissionrate" => array(
			"id" => mysqli_insert_id($conn),
			"collector_id" => $collector_id,
			"month_id" => $month_id,
			"sub_group_code" => $sub_group_code,
			"amount"=>$amount,
			"comm_rate"=>$comm_rate,
			"comm_amount"=>$comm_amount
		)
	));
?>