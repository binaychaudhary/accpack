<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['kitchenorders'];

	$data = json_decode($info);
	$locationId=$data->locationId;
	$itemId = $data->itemId;
	$qty=$data->qty;
	$rate=$data->rate;
	$amount=$data->amount;
	$unit=$data->unit;
	$entry_date_bs = $data->entry_date_bs;
	$waiter_id =$data->waiter_id;
	$no_of_pax=$data->no_of_pax;
	$kot_id=$data->kot_id;
	$status = 1;

	// $locationId=$_REQUEST['locationId'];
	// $itemId = $_REQUEST['itemId'];
	// $qty=$_REQUEST['qty'];
	// $rate=$_REQUEST['rate'];
	// $amount=$_REQUEST['amount'];
	// $unit=$_REQUEST['unit'];
	// $entry_date_bs = $_REQUEST['entry_date_bs'];
	// $waiter_id =$_REQUEST['waiter_id'];
	// $no_of_pax=$_REQUEST['no_of_pax'];
	// $kot_id=$_REQUEST['kot_id'];
	// $status = 1;

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
	$query = sprintf("INSERT INTO kitchen_order (locationId, itemId, qty, rate, amount, entry_date_bs, waiter_id, no_of_pax,status,kot_id) values ('%d','%d','%s','%s','%s','%s','%d','%d','%d','%d')",
		$conn->real_escape_string($locationId),
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($waiter_id),
		$conn->real_escape_string($no_of_pax),
		$conn->real_escape_string($status),
		$conn->real_escape_string($kot_id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"kitchenorders" => array(
			"id" => mysqli_insert_id($conn),
			"locationId"=>$locationId,
			"itemId" => $itemId,
			"qty"=>$qty,
			"rate"=>$rate,
			"amount"=>$amount,
			"unit"=>$unit,
			"status" => $status,
			"location_name"=>$location_name,
			"itemName"=>$item_name,
			"entry_date_bs"=>$entry_date_bs,
			"waiter_id"=>$waiter_id,
			"no_of_pax"=>$no_of_pax,
			"waiter_name"=>$waiter_name,
			"alias_name"=>$alias_name,
			"kot_id"=>$kot_id
		)
	));
?>