<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	// $conn->query("SET NAMES utf8");  
	// $info = $_POST['invitempurchaserates'];

	//$data = json_decode($info);

	$itemId = $_REQUEST['itemId'];
	$qty = $_REQUEST['qty'];
	$purchase_rate=$_REQUEST['purchase_rate'];
	$sales_rate=$_REQUEST['sales_rate'];

	$effective_date_bs=$_REQUEST['effective_date_bs'];
	$effective_date_ad=$_REQUEST['effective_date_ad'];	
	if((is_null($qty)) || ($qty=='')){
		$qty=0;
	}
	if((is_null($purchase_rate)) || ($purchase_rate=='')){
		$purchase_rate=0;
	}
	if((is_null($sales_rate)) || ($sales_rate=='')){
		$sales_rate=0;
	}
	//if((is_null($discount_rate)) || ($discount_rate=='')){
	$discount_rate=0;
	//}
	
	$sql = "update inv_item set qty='$qty', rate = '$purchase_rate', sales_rate='$sales_rate' where id = '$itemId'";
	$conn->query($sql);

	$rs   = $conn->query("select * from inv_item_put_rate where itemId='".$itemId."'");
	$nor = mysqli_num_rows($rs);
	$query1="";
	//consulta sql
	if($nor>0){
		$query1="update inv_item_put_rate set purchase_rate = '$purchase_rate', effective_date_bs='$effective_date_bs', effective_date_ad='$effective_date_ad' where itemId='$itemId'";
	}else{

		$query1 = sprintf("INSERT INTO inv_item_put_rate (itemId, purchase_rate, effective_date_bs, effective_date_ad,discount_rate) values ('%d','%s','%s','%s','%s')",
			$conn->real_escape_string($itemId),
			$conn->real_escape_string($purchase_rate),
			$conn->real_escape_string($effective_date_bs),
			$conn->real_escape_string($effective_date_ad),
			$conn->real_escape_string($discount_rate)
			);
	}
	$conn->query($query1);

	$rs=$conn->query("select * from inv_item_rate where itemId='".$itemId."'");
	//print_r($rs);
	$nor = mysqli_num_rows($rs);

	$sales_rate_type_id=1;

	//consulta sql
	$query2="";
	if($nor>0){
		$query2="update inv_item_rate set sales_rate = '$sales_rate' where itemId='$itemId'";

	},{
		$query2 = sprintf("INSERT INTO inv_item_rate (itemId, sales_rate, effective_date_bs, effective_date_ad,discount_rate, sales_rate_type_id) values ('%d','%s','%s','%s','%s','%d')",
			$conn->real_escape_string($itemId),
			$conn->real_escape_string($sales_rate),
			$conn->real_escape_string($effective_date_bs),
			$conn->real_escape_string($effective_date_ad),
			$conn->real_escape_string($discount_rate),
			$conn->real_escape_string($sales_rate_type_id)
		);
	}
	$conn->query($query2);

	echo json_encode(array(
		"success" => 1,
		"qry1" =>$query1,
		"qry2" =>$query2
 	));
?>