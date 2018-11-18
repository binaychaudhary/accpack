<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['purchaseorderdetails'];

	$data = json_decode($info);
	
	$order_id = $data->order_id;
	$item_id = $data->item_id;
	$unit_id = $data->unit_id;
	$qty = $data->qty;
	$rate = $data->rate;
	$amount=$data->amount;
	$user_id=$data->user_id;



	// $order_id = $_REQUEST['order_id'];
	// $item_id = $_REQUEST['item_id'];
	// $unit_id = $_REQUEST['unit_id'];
	// $qty = $_REQUEST['qty'];
	// $rate = $_REQUEST['rate'];
	// $amount=$_REQUEST['amount'];
	// $user_id=$_REQUEST['user_id'];

	$sql = "select * from inv_item where id='".$item_id."'";
	$rs = $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$item_name=$r['item_name'];

	$sql = "select * from unit where id='".$unit_id."'";
	$rs = $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$unit=$r['ShortName'];

	//consulta sql
	$query = sprintf("INSERT INTO purchase_order_detail (order_id, item_id, unit_id, qty, rate, amount, user_id) values ('%d','%d','%d','%s','%s','%s','%d')",
		$conn->real_escape_string($order_id),
		$conn->real_escape_string($item_id),
		$conn->real_escape_string($unit_id),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($user_id)
	);
	//echo $query;
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"purchaseorderdetails" => array(
			"id" => mysqli_insert_id($conn),
			"order_id" => $order_id,
			"item_id" => $item_id,
			"unit_id" => $unit_id,
			"qty" => $qty,
			"rate" => $rate,
			"amount"=>$amount,
			"user_id"=>$user_id,
			"item_name" =>$item_name,
			"unit" =>$unit
		)
	));
?>