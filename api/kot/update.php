<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['kots'];

	$data = json_decode($info);
	$id = $data->id;
	$user_id=$data->user_id;
	$table_id = $data->table_id;
	$entry_date_bs = $data->entry_date_bs;
	$entry_date_ad = $data->entry_date_ad;
	$no_of_pax = $data->no_of_pax;
	$status=$data->status;

	date_default_timezone_set('Asia/Kathmandu');
	$entry_date_ad=substr($entry_date_ad,0,10).' '.date("H:i:s");

	$rs=$conn->query("select * from staff where id='".$user_id."'");
	$r=mysqli_fetch_assoc($rs);
	$user_name=$r['staffName'];

	$rs=$conn->query("select * from location where id='".$table_id."'");
	$r=mysqli_fetch_assoc($rs);
	$table_name=$r['location_name'];

	//consulta sql
	$query = sprintf("UPDATE kot SET user_id = '%d',table_id = '%d',status = '%d',entry_date_bs = '%s',entry_date_ad = '%s', no_of_pax='%d' WHERE id=%d",
		$conn->real_escape_string($user_id),
		$conn->real_escape_string($table_id),
		$conn->real_escape_string($status),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad),
		$conn->real_escape_string($no_of_pax),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"kots" => array(
			"id" => $id,
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