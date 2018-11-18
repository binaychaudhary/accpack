<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	
	$rs= $conn->query("select * from app_setting where setting_name ='Purchase Accounts'");
	if(mysqli_num_rows($rs)){
		$r= mysqli_fetch_assoc($rs);
		$PurchaseAccont=$r['value_txt'];
	}

	$cr="";
	if(is_null($PurchaseAccont)||($PurchaseAccont=="")){
	}else{
		$cr=" where accountNo like '".$PurchaseAccont . "%'";
	}
	
	$queryString = "SELECT * from acmaster ".$cr;
	//echo $queryString;
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
		"accounts" => $data
	));
?>