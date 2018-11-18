<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$ordered_to=$_REQUEST['ordered_to'];
	$is_email_sent=$_REQUEST['is_email_sent'];
	$status=$_REQUEST['status'];
	$cr="";
	
	if(is_null($ordered_to)||($ordered_to=="")){
	}else{
		if($cr==""){
			$cr=" where po.ordered_to = '".$ordered_to . "%'";
		}else{
			$cr = $cr." and po.ordered_to = '".$ordered_to . "%'";
		}
	}
	if(is_null($is_email_sent)||($is_email_sent=="")){
	}else{
		if($cr==""){
			$cr=" where po.is_email_sent = '".$is_email_sent . "'";
		}else{
			$cr = $cr." and po.is_email_sent = '".$is_email_sent . "'";
		}
	}
	if(is_null($status	)||($status	=="")){
	}else{
		if($cr==""){
			$cr=" where po.status	 = '".$status. "'";
		}else{
			$cr = $cr." and po.status	 = '".$status. "'";
		}
	}
	
	$queryString = "SELECT po.*, accm.accountDesc as ordered_to_desc from purchase_order po left join acmaster accm on po.ordered_to = accm.id  ".$cr." order by order_date_ad";
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
		"purchaseorders" => $data
	));
?>