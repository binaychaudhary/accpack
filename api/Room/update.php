<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['rooms'];

	$data = json_decode($info);
	$id=$data->id;
	$room_type_id = $data->room_type_id;
	$bed_type_id = $data->bed_type_id;
	$room_no = $data->room_no;
	$status=$data->status;

	$sql="select * from room_type where id='".$room_type_id."'";
	$rs= $conn->query($sql);
	$r=$conn->fetch_assoc($rs);
	$rdescription=$r['rdescription'];

	$sql="select * from bed_type where id='".$bed_type_id."'";
	$rs= $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$bdescription=$r['bdescription'];
	
	

	//consulta sql
	$query = sprintf("UPDATE room SET room_type_id = '%d',room_no='%s',bed_type_id='%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($room_type_id),
		$conn->real_escape_string($room_no),
		$conn->real_escape_string($bed_type_id),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"rooms" => array(
			"id" => $id,
			"room_type_id" => $room_type_id,
			"rdescription" => $rdescription,
			"bed_type_id" => $bed_type_id,
			"bdescription" => $bdescription,
			"room_no" => $room_no,
			"status"=>$status
		)
	));
?>