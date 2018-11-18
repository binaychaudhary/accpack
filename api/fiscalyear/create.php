<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['fiscalyears'];

	$data = json_decode($info);
	
	$fiscalyear = $data->fiscalyear;
	$status = $data->status;
	$start_date_bs=$data->start_date_bs;
	$end_date_bs=$data->end_date_bs;
	$start_date_ad=date('Y-m-d',strtotime($data->start_date_ad));
	$end_date_ad=date('Y-m-d',strtotime($data->end_date_ad));
	if($status==1){
		$qry="update fiscalyear set status=0";
		$conn->query($qry);
	}

	//consulta sql
	$query = sprintf("INSERT INTO fiscalyear (fiscalyear,status,start_date_bs,end_date_bs,start_date_ad, end_date_ad) values ('%s','%d','%s','%s','%s','%s')",
		$conn->real_escape_string($fiscalyear),
		$conn->real_escape_string($status),
		$conn->real_escape_string($start_date_bs),
		$conn->real_escape_string($end_date_bs),
		$conn->real_escape_string($start_date_ad),
		$conn->real_escape_string($end_date_ad)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"fiscalyears" => array(
			"id" => mysqli_insert_id($conn),
			"fiscalyear" => $fiscalyear,
			"status" => $status,
			"start_date_bs"=>$start_date_bs,
			"end_date_bs"=>$end_date_bs,
			"start_date_ad"=>$start_date_ad,
			"end_date_ad"=>$end_date_ad
		)
	));
?>