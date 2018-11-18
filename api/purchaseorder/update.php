<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['purchaseorders'];

	$data = json_decode($info);
	$id=$data->id;
	$order_date_bs = $data->order_date_bs;
	$order_date_ad = $data->order_date_ad;
	$created_by = $data->created_by;
	$ordered_to = $data->ordered_to;
	$email_address = $data->email_address;
	$status=$data->status;
	
	// $id=$_REQUEST['id'];
	// $order_date_bs = $_REQUEST['order_date_bs'];
	// $order_date_ad = $_REQUEST['order_date_ad'];
	// $created_by = $_REQUEST['created_by'];
	// $ordered_to = $_REQUEST['ordered_to'];
	// $email_address = $_REQUEST['email_address'];
	// $status=$_REQUEST['status'];
	
	$dt = strtotime($order_date_ad);

	$order_date_ad = date('Y-m-d',$dt);

	//consulta sql
	$query = sprintf("UPDATE purchase_order SET order_date_bs = '%s', order_date_ad = '%s', created_by = '%s', ordered_to = '%d', email_address = '%s', status = '%s' WHERE id='%d'",
		$conn->real_escape_string($order_date_bs),
		$conn->real_escape_string($order_date_ad),
		$conn->real_escape_string($created_by),
		$conn->real_escape_string($ordered_to),
		$conn->real_escape_string($email_address),
		$conn->real_escape_string($status),
		$id
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"purchaseorders" => array(
			"id" => $id,
			"order_date_bs" => $order_date_bs,
			"order_date_ad" => $order_date_ad,
			"created_by" => $created_by,
			"ordered_to" => $ordered_to,
			"email_address" => $email_address,
			"status"=>$status
		)
	));
?>