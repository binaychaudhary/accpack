<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$order_id=$_REQUEST['order_id'];
	$item_name=$_REQUEST['item_name'];
	$cr="";
	
	if(is_null($order_id)||($order_id=="")){
	}else{
		if($cr==""){
			$cr=" where pod.order_id = '".$order_id . "%'";
		}else{
			$cr = $cr." and pod.order_id = '".$order_id . "%'";
		}
	}
	if(is_null($item_name)||($item_name=="")){
	}else{
		if($cr==""){
			$cr=" where itm.item_name like '".$item_name . "%'";
		}else{
			$cr = $cr." itm.item_name like '".$item_name . "%'";
		}
	}
	
	$queryString = "SELECT pod.*, itm.item_name,u.ShortName as unit from purchase_order_detail pod left join inv_item itm on pod.item_id = itm.id left join unit u on pod.unit_id = u.id ".$cr." order by order_id";
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"purchaseorderdetails" => $data
	));
?>