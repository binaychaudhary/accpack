<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['consumerconnectionhistry'];

	$data = json_decode($info);
	
	$consumer_id = $data->consumer_id;
	$status_id=$data->status_id;
	$entry_date_ad=$data->entry_date_ad;
	$entry_date_bs=$data->entry_date_bs;
	$created_by=$data->created_by;
	
	// $consumer_id = $_REQUEST['consumer_id'];
	// $status_id=$_REQUEST['status_id'];
	// $entry_date_ad=$_REQUEST['entry_date_ad'];
	// $entry_date_bs=$_REQUEST['entry_date_bs'];
	// $created_by=$_REQUEST['created_by'];

	//consulta sql
	$query = sprintf("INSERT INTO consumer_connection_histry (consumer_id, status_id, entry_date_bs, entry_date_ad, created_by) values ('%d','%d','%s','%s','%d')",
		$conn->real_escape_string($consumer_id),
		$conn->real_escape_string($status_id),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad),
		$conn->real_escape_string($created_by)
	);

	$rs = $conn->query($query);

	$sql="select * from pipeline_meter_status where id='".$status_id."'";
	$rs = $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$status_name = $r['status_name'];

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"consumerconnectionhistry" => array(
			"id"=>mysqli_insert_id($conn),
			"consumer_id" => $consumer_id,
			"status_id" => $status_id,
			"entry_date_bs" => $entry_date_bs,
			"entry_date_ad" => $entry_date_ad,
			"created_by" => $created_by,
			"status_name" => $status_name
		)
	));
?>