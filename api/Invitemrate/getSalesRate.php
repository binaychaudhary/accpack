<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$entry_date_ad=$_REQUEST['entry_date_ad'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];

	if($sourceCodeId=="5"){
		$queryString = "select invR.sales_rate,invR.discount_rate from inv_item_rate invR where invR.itemId='".$itemId."' and sales_rate_type_id=1 order by effective_date_ad desc limit 1";
	}else if($sourceCodeId=="7"){
		$queryString = "select invR.sales_rate,invR.discount_rate from inv_item_rate invR where invR.itemId='".$itemId."' and sales_rate_type_id=2 order by effective_date_ad desc limit 1";
	}
	

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());
	if(mysqli_num_rows($query)){
		$found=true;
		$rs = mysqli_fetch_assoc($query);
		$sales_rate = $rs['sales_rate'];
		$discount_rate =$rs['discount_rate'];
	}else{
		$found=false;
		$sales_rate = 0;
		$discount_rate =0;
	}
	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"found"=>$found,
		"sales_rate" => $sales_rate,
		"discount_rate" =>$discount_rate,
		"queryString"=>$queryString
	));
?>