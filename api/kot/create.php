<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['kots'];

	$data = json_decode($info);
	$entry_date_bs=$data->entry_date_bs;
	$entry_date_ad=$data->entry_date_ad;
	$user_id=$data->user_id;
	$table_id = $data->table_id;
	$no_of_pax = $data->no_of_pax;
	$status = $data->status;


	date_default_timezone_set('Asia/Kathmandu');

	// $entry_date_bs=$_REQUEST['entry_date_bs'];
	// $entry_date_ad=$_REQUEST['entry_date_ad'];
	// $user_id=$_REQUEST['user_id'];
	// $table_id = $_REQUEST['table_id'];
	// $no_of_pax = $_REQUEST['no_of_pax'];
	// $status = $_REQUEST['status'];
	$entry_date_ad=substr($entry_date_ad,0,10).' '.date("H:i:s");

	$rs=$conn->query("select * from staff where id='".$user_id."'");
	$r=mysqli_fetch_assoc($rs);
	$user_name=$r['staffName'];

	$rs=$conn->query("select * from location where id='".$table_id."'");
	$r=mysqli_fetch_assoc($rs);
	$table_name=$r['location_name'];

	//consulta sql
	$query = sprintf("INSERT INTO kot (user_id, table_id, entry_date_bs, entry_date_ad, no_of_pax, status) values ('%d','%d','%s','%s','%d','%d')",
		$conn->real_escape_string($user_id),
		$conn->real_escape_string($table_id),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad),
		$conn->real_escape_string($no_of_pax),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"kots" => array(
			"id" => mysqli_insert_id($conn),
			"user_id"=>$user_id,
			"table_id" => $table_id,
			"user_name" => $user_name,
			"table_name"=>$table_name,
			"entry_date_bs"=>$entry_date_bs,
			"entry_date_ad"=>$entry_date_ad,
			"no_of_pax"=>$no_of_pax,
			"status" =>$status
		)
	));
?>