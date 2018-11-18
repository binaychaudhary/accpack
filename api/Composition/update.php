<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['compositions'];

	$data = json_decode($info);
	$id=$data->id;
	$mainItemId = $data->mainItemId;
	$itemId = $data->itemId;
	$unitId = $data->unitId;
	$qty = $data->qty;

	$rs=$conn->query("select * from inv_item where id='".$itemId."'");
	$r=mysqli_fetch_assoc($rs);
	$item_name=$r['item_name'];

	$rs=$conn->query("select * from unit where id='".$unitId."'");
	$r=mysqli_fetch_assoc($rs);
	$unit=$r['Unit'];
	
	//consulta sql
	$query = sprintf("UPDATE composition SET itemId = '%s', unitId = '%d', qty='%s' WHERE id=%d",
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($unitId),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"compositions" => array(
			"id" => $id,
			"mainItemId" => $mainItemId,
			"item_name" => $item_name,
			"unitId"=>$unitId,
			"itemId"=>$itemId,
			"qty"=>$qty,
			"unit"=>$unit
		)
	));
?>