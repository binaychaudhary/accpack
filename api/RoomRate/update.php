<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	// $info = $_POST['lodges'];

	// $data = json_decode($info);
	// $id=$data->id;
	// $edate_bs = $data->edate_bs;
	// $edate_ad = $data->edate_ad;
	// $guest_id=$data->guest_id;
	// $no_of_guest = $data->no_of_guest;
	// $dept_date_bs=$data->dept_date_bs;
	// $dept_date_ad=$data->dept_date_ad;
	// $no_of_day=$data->no_of_day;
	$id=$_REQUEST['id'];
	$room_id=$_REQUEST['room_id'];
	$rate=$_REQUEST['rate'];
	$effective_date_bs=$_REQUEST['effective_date_bs'];
	$effective_date_ad=$_REQUEST['effective_date_ad'];
	

	$sql="select * from room_type where id='".$room_id."'";
	$rs= $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$rdescription=$r['rdescription'];

	//consulta sql
	$query = "UPDATE room_rate SET room_id = '".$room_id."',rate = '".$rate."', effective_date_bs = '".$effective_date_bs."', effective_date_ad = '".$effective_date_ad."' WHERE id='".$id."'";
		
	

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"roomrates" => array(
			"id" => $id,
			"room_id" => $room_id,
			"rate" => $rate,
			"rdescription" => $rdescription,
			"effective_date_bs" => $effective_date_bs,
			"effective_date_ad" => $effective_date_ad,
			"q"=>$query
		)
	));
?>