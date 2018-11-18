<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['invitempurchaserates'];

	$data = json_decode($info);
	$id = $data->id;
	$itemId=$data->itemId;
	$purchase_rate=$data->purchase_rate;
	$effective_date_bs=$data->effective_date_bs;
	$effective_date_ad=$data->effective_date_ad;
	$discount_rate=$data->discount_rate;

	$rs=$conn->query("select * from inv_item where id='".$itemId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$item_name=$r['item_name'];
	}
	//consulta sql
	$query = sprintf("UPDATE inv_item_put_rate SET purchase_rate = '%s', effective_date_bs='%s', effective_date_ad = '%s', discount_rate='%s' WHERE id=%d",
		$conn->real_escape_string($purchase_rate),
		$conn->real_escape_string($effective_date_bs),
		$conn->real_escape_string(date('Y-m-d',strtotime($effective_date_ad))),
		$conn->real_escape_string($discount_rate),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invitempurchaserates" => array(
			"id" => $id,
			"itemId" => $itemId,
			"purchase_rate"=>$sales_rate,
			"effective_date_bs" => $effective_date_bs,
			"effective_date_ad" => $effective_date_ad,
			"discount_rate" =>$discount_rate,
			"item_name"=>$item_name
		)
	));
?>