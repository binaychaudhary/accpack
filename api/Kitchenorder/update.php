<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['kitchenorders'];

	$data = json_decode($info);
	$id = $data->id;
	$locationId=$data->locationId;
	$kot_id = $data->kot_id;
	$itemId = $data->itemId;
	$entry_date_bs= $data->entry_date_bs;
	$qty=$data->qty;
	$unit = $data->unit;
	$rate=$data->rate;
	$amount=$data->amount;
	$waiter_id=$data->waiter_id;
	$no_of_pax=$data->no_of_pax;
	$status = 1;


	$rs=$conn->query("select * from location where id='".$locationId."'");
	$r=mysqli_fetch_assoc($rs);
	$location_name=$r['location_name'];

	$rs=$conn->query("select * from inv_item where id='".$itemId."'");
	$r=mysqli_fetch_assoc($rs);
	$item_name=$r['item_name'];
	$alias_name = $r['alias_name'];
	$unitId = $r['unit_id'];

	$rs=$conn->query("select * from staff where id='".$waiter_id."'");
	$r=mysqli_fetch_assoc($rs);
	$waiter_name=$r['staffName'];

	//consulta sql
	$query = sprintf("UPDATE kitchen_order SET locationId = '%d',itemId = '%d', qty='%s', rate = '%s', amount='%s', entry_date_bs='%s', waiter_id='%d', no_of_pax='%d' WHERE id=%d",
		$conn->real_escape_string($locationId),
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($waiter_id),
		$conn->real_escape_string($no_of_pax),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"kitchenorders" => array(
			"id" => $id,
			"locationId"=>$locationId,
			"itemId" => $itemId,
			"qty"=>$qty,
			"rate"=>$rate,
			"unit"=>$unit,
			"amount"=>$amount,
			"status" => $status,
			"location_name"=>$location_name,
			"itemName"=>$item_name,
			"entry_date_bs"=>$entry_date_bs,
			"alias_name"=>$alias_name,
			"waiter_id"=>$waiter_id,
			"no_of_pax"=>$no_of_pax,
			"waiter_name"=>$waiter_name,
			"kot_id"=>$kot_id
		)
	));
?>