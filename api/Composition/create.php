<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	 $info = $_POST['compositions'];

	 $data = json_decode($info);

	$mainItemId = $data->mainItemId;
	$itemId = $data->itemId;
	$qty=$data->qty;
	$unitId=$data->unitId;

	$rs=$conn->query("select * from inv_item where id='".$itemId."'");
	$r=mysqli_fetch_assoc($rs);
	$item_name=$r['item_name'];

	$rs=$conn->query("select * from unit where id='".$unitId."'");
	$r=mysqli_fetch_assoc($rs);
	$unit=$r['Unit'];
	
	//consulta sql
	$query = sprintf("INSERT INTO composition(mainItemId, itemId, qty, unitId) values ('%d','%d','%s','%d')",
		$conn->real_escape_string($mainItemId),
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($unitId)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"compositions" => array(
			"mainItemId" => $mainItemId,
			"itemId" => $itemId,
			"qty"=>$qty,
			"unitId"=>$unitId,
			"item_name"=>$item_name,
			"unit"=>$unit
		)
	));
?>