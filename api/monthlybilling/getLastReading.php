<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	

	$consumer_id=$_REQUEST['consumer_id'];
	$entry_date_ad = $_REQUEST['entry_date_ad'];

	$sql="select * from monthlybill where consumer_id='".$consumer_id."' and entry_date_ad<'".$entry_date_ad."' order by id desc";
	//echo $sql;
	$rs =$conn->query($sql);
	$lastReading=0;
	if(mysqli_num_rows(	$rs)){
		$r =mysqli_fetch_assoc($rs);
		$lastReading=$r['cur_reading'];
	}else{
		$lastReading=0;
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"lastReading" => $lastReading
	));
?>