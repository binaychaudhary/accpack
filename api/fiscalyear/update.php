<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['fiscalyears'];

	$data = json_decode($info);
	$id=$data->id;
	$fiscalyear=$data->fiscalyear;
	$status = $data->status;
	$start_date_bs=$data->start_date_bs;
	$end_date_bs=$data->end_date_bs;
	$start_date_ad=$data->start_date_ad;
	$end_date_ad=$data->end_date_ad;
	
	// $id=$_REQUEST['id'];
	// $fiscalyear=$_REQUEST['fiscalyear'];
	// $status = $_REQUEST['status'];
	// $start_date_bs=$_REQUEST['start_date_bs'];
	// $end_date_bs=$_REQUEST['end_date_bs'];
	// $start_date_ad=$_REQUEST['start_date_ad'];
	// $end_date_ad=$_REQUEST['end_date_ad'];

	if($status==1){
		$qry="update fiscalyear set status=0";
		$conn->query($qry);
	}
	//consulta sql
	$query = "UPDATE fiscalyear SET fiscalyear = '".$fiscalyear."', status = '".$status."', start_date_bs='".$start_date_bs."', end_date_bs='".$end_date_bs."',start_date_ad='".date('Y-m-d',strtotime($start_date_ad))."', end_date_ad='".date('Y-m-d',strtotime($end_date_ad))."' WHERE id='".$id."'";
	
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"fiscalyears" => array(
			"id" => $id,
			"fiscalyear" => $fiscalyear,
			"status" => $status,
			"start_date_bs"=>$start_date_bs,
			"end_date_bs"=>$end_date_bs,
			"start_date_ad"=>$start_date_ad,
			"end_date_ad"=>$end_date_ad
		)
	));
?>