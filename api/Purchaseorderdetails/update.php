<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['purchaseorderdetails'];

	$data = json_decode($info);
	$id=$data->id;
	$order_id = $data->order_id;
	$item_id = $data->item_id;
	$unit_id = $data->unit_id;
	$qty = $data->qty;
	$rate = $data->rate;
	$amount=$data->amount;
	$user_id=$data->user_id;

	// $id=$_REQUEST['id'];
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
	$query = sprintf("UPDATE purchase_order_detail SET item_id = '%d', unit_id = '%d', qty = '%s', rate = '%s', amount = '%s', user_id = '%d' WHERE id='%d'",
		$conn->real_escape_string($item_id),
		$conn->real_escape_string($unit_id),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($user_id),
		$id
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"purchaseorderdetails" => array(
			"id" => $id,
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