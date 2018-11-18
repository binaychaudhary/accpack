<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$report_from = $_REQUEST['report_from'];
	$report_upto = $_REQUEST['report_upto'];
	
	
	//calculating current period purchase
	$sql="select * from stock where itemId='$itemId' and entry_date_ad>='$report_from' and entry_date_ad<='$report_upto' order by entry_date_ad";
	$rs= $conn->query($sql);
	
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"stockdetail" => $data
	));

?>