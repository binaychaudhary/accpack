<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$accountNo = $_REQUEST['accountNo'];
	$entryDateAd = $_REQUEST['entry_date_ad'];
	$balance =0;
	

	$sql ="select  sum(credit) as crd from tmpentry where accountNo ='".$accountNo."' and entry_date_ad> '$entryDateAd'";
	//consulta sql
	// $sql;
	$rs = $conn->query($sql) or die(mysqli_error());
	if (mysqli_num_rows($rs)>0){
		$r = mysqli_fetch_assoc($rs);
		$creditSum= $r['crd'];

		$balance =  $creditSum;
	}else{
		$balance =0;
	}

	

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sql" => $sql,
		"balance" => $balance
	));
?>