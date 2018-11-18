<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['roomrates'];

	// $data = json_decode($info);
	
	// $room_id = $data->room_id;
	// $rate = $data->rate;
	// $guest_id=$data->guest_id;
	// $effective_date_bs = $data->effective_date_bs;
	// $effective_date_ad=$data->effective_date_ad;
	
	$room_id=$_REQUEST['room_id'];
	$rate=$_REQUEST['rate'];
	$effective_date_bs=$_REQUEST['effective_date_bs'];
	$effective_date_ad=$_REQUEST['effective_date_ad'];
	

	$sql1="select * from room_type where id='".$room_id."'";
	$rs= $conn->query($sql1);
	$r=mysqli_fetch_assoc($rs);
	$rdescription=$r['rdescription'];
	//consulta sql
	$sql ="insert into room_rate(room_id";
	$sql .= ",rate";
	$sql .= ",effective_date_bs";
	$sql .= ",effective_date_ad)";
	
	$sql .= " values(";
	$sql .= "'".$room_id."'";
	$sql .= ",'".$rate."'";
	$sql .= ",'".$effective_date_bs."'";
	$sql .= ",'".$effective_date_ad."')";
	

	$rs=$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"roomrates" => array(
			"id" => mysqli_insert_id($conn),
			"room_id" => $room_id,
			"rate" => $rate,
			"rdescription" => $rdescription,
			"effective_date_bs" => $effective_date_bs,
			"effective_date_ad" => $effective_date_ad,
			'q'=>$sql,
			'qt'=>$sql1
		)
	));
?>