<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['invitemrates'];

	$data = json_decode($info);

	$itemId = $data->itemId;
	$sales_rate=$data->sales_rate;
	$effective_date_bs=$data->effective_date_bs;
	$effective_date_ad=date('Y-m-d',strtotime($data->effective_date_ad));
	$discount_rate=$data->discount_rate;
	$sales_rate_type_id =$data->sales_rate_type_id;


	// $itemId = $_REQUEST['itemId'];
	// $sales_rate=$_REQUEST['sales_rate'];
	// $effective_date_bs=$_REQUEST['effective_date_bs'];
	// $effective_date_ad=date('Y-m-d',strtotime($_REQUEST['effective_date_ad']));
	// $discount_rate=$_REQUEST['discount_rate'];
	// $sales_rate_type_id =$_REQUEST['sales_rate_type_id'];

	if((is_null($discount_rate)) || ($discount_rate=='')){
		$discount_rate=0;
	}
	$rs=$conn->query("select * from inv_item where id='".$itemId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$item_name=$r['item_name'];
	}

	$rs=$conn->query("select * from inv_sales_rate_type where id='".$sales_rate_type_id."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$sales_rate_type=$r['sales_rate_type'];
	}
	//consulta sql
	$query = sprintf("INSERT INTO inv_item_rate (itemId, sales_rate, effective_date_bs, effective_date_ad,discount_rate, sales_rate_type_id) values ('%d','%s','%s','%s','%s','%s')",
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($sales_rate),
		$conn->real_escape_string($effective_date_bs),
		$conn->real_escape_string($effective_date_ad),
		$conn->real_escape_string($discount_rate),
		$conn->real_escape_string($sales_rate_type_id)
		);
	//echo $query;
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invitemrates" => array(
			"id" => mysqli_insert_id($conn),
			"itemId" => $itemId,
			"sales_rate"=>$sales_rate,
			"effective_date_bs" => $effective_date_bs,
			"effective_date_ad" => $effective_date_ad,
			"item_name"=>$item_name,
			"discount_rate" =>$discount_rate,
			"sales_rate_type_id" => $sales_rate_type_id,
			"sales_rate_type" => $sales_rate_type
		)
	));
?>