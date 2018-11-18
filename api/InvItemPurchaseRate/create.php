<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['invitempurchaserates'];

	$data = json_decode($info);

	$itemId = $data->itemId;
	$purchase_rate=$data->purchase_rate;
	$effective_date_bs=$data->effective_date_bs;
	$effective_date_ad=date('Y-m-d',strtotime($data->effective_date_ad));
	$discount_rate=$data->discount_rate;
	
	if((is_null($discount_rate)) || ($discount_rate=='')){
		$discount_rate=0;
	}
	
	$rs=$conn->query("select * from inv_item where id='".$itemId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$item_name=$r['item_name'];
	}
	//consulta sql
	$query = sprintf("INSERT INTO inv_item_put_rate (itemId, purchase_rate, effective_date_bs, effective_date_ad,discount_rate) values ('%d','%s','%s','%s','%s')",
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($purchase_rate),
		$conn->real_escape_string($effective_date_bs),
		$conn->real_escape_string($effective_date_ad),
		$conn->real_escape_string($discount_rate)
		);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invitempurchaserates" => array(
			"id" => mysqli_insert_id($conn),
			"itemId" => $itemId,
			"purchase_rate"=>$purchase_rate,
			"effective_date_bs" => $effective_date_bs,
			"effective_date_ad" => $effective_date_ad,
			"item_name"=>$item_name,
			"discount_rate" =>$discount_rate
		)
	));
?>