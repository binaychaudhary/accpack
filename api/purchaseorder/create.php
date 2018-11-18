<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['purchaseorders'];

	$data = json_decode($info);
	
	$order_date_bs = $data->order_date_bs;
	$order_date_ad = $data->order_date_ad;
	$created_by = $data->created_by;
	$ordered_to = $data->ordered_to;
	$email_address = $data->email_address;
	$status=$data->status;

	$dt = strtotime($order_date_ad);

	$order_date_ad = date('Y-m-d',$dt);
	
	
	// $order_date_bs = $_REQUEST['order_date_bs'];
	// $order_date_ad = $_REQUEST['order_date_ad'];
	// $created_by = $_REQUEST['created_by'];
	// $ordered_to = $_REQUEST['ordered_to'];
	// $email_address = $_REQUEST['email_address'];
	// $status=$_REQUEST['status'];


	//consulta sql
	$query = sprintf("INSERT INTO purchase_order (order_date_bs, order_date_ad, created_by, ordered_to, email_address, status) values ('%s','%s','%d','%d','%s','%d')",
		$conn->real_escape_string($order_date_bs),
		$conn->real_escape_string($order_date_ad),
		$conn->real_escape_string($created_by),
		$conn->real_escape_string($ordered_to),
		$conn->real_escape_string($email_address),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"purchaseorders" => array(
			"id" => mysqli_insert_id($conn),
			"order_date_bs" => $order_date_bs,
			"order_date_ad" => $order_date_ad,
			"created_by" => $created_by,
			"ordered_to" => $ordered_to,
			"email_address" => $email_address,
			"status"=>$status
		)
	));
?>