<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$consumer_id=$_REQUEST['consumer_id'];
	$yrmn = $_REQUEST['yrmn'];

	$sql="select *, concat(yr,right(concat('0',mn),2)) as yrmn from monthlybill where consumer_id='".$consumer_id."' and yrmn<'".$yrmn."' order by yrmn desc";
	//echo $sql;
	$rs = $conn->query($sql);
	$lastReading=0;
	if(mysqli_num_rows(	$rs)){
		$r =mysqli_fetch_assoc($rs);
		$lastReading=$r['cur_reading'];
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"lastReading" => $lastReading
	));
?>