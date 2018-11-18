<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$entry_date_ad=$_REQUEST['entry_date_ad'];
	
	$queryString = "select invR.purchase_rate,invR.discount_rate from inv_item_put_rate invR where invR.itemId='".$itemId."' order by effective_date_ad desc limit 1";
	
	
	$discount_rate=0;
	$purchase_rate=0;
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());
	if(mysqli_num_rows($query)){
		$found=true;
		$rs = mysqli_fetch_assoc($query);
		$purchase_rate = $rs['purchase_rate'];
		$discount_rate =$rs['discount_rate'];
	}else{
		$found=false;
		$purchase_rate = 0;
		$discount_rate =0;
	}
	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"found"=>$found,
		"purchase_rate" => $purchase_rate,
		"discount_rate" =>$discount_rate,
		"queryString"=>$queryString
	));
?>