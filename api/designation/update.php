<?php
	include("../conn.php");
	
	$info = $_POST['designation'];

	$data = json_decode(stripslashes($info));

	$id=$data->id;
	$designation = $data->designation;
	$status = $data->status;

	$sql ="update design set designation='$designation',status='$status' where id=$id";

	$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"designation" => array(
			"id" => $id,
			"designation" => $designation,
			"status" > $status,
		)
	));

?>