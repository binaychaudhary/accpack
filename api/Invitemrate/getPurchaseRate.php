<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$entry_date_ad=$_REQUEST['entry_date_ad'];

	$queryString = "select invR.purchase_rate,invR.discount_rate from inv_item_put_rate invR where invR.itemId='".$itemId."' order by effective_date_ad desc limit 1";
	//$queryString = "select invR.sales_rate from inv_item_rate invR where invR.itemId='".$itemId."' and effective_date_ad<='$entry_date_ad' order by effective_date_ad desc limit 1";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());
	if(mysqli_num_rows($query)){
		$found=true;
	}else{
		$found=false;
	}
	$rs = mysqli_fetch_assoc($query);
	$purchase_rate = $rs['purchase_rate'];
	$discount_rate =$rs['discount_rate'];
	

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"found"=>$found,
		"purchase_rate" => $purchase_rate,
		"discount_rate" =>$discount_rate,
		"queryString"=>$queryString
	));
?>