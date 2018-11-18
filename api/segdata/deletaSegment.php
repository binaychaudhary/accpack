<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$info = $_POST['segmentdatas'];

	$data = json_decode($info);

	$id = $data->id;
	if($data->segment_id=="19"){
		$subGroupCode =$data->segment_code;
		$dl ="delete from subgroup where groupId='19'  and subGroupCode='$subGroupCode'";
		$conn->query($dl);
	}
	//consulta sql
	$query = sprintf("DELETE FROM segmentdata WHERE id=%d",
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	$qry="delete from subgroup where "
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>