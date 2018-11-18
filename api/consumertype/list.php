<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$sql="select * from consumer_type order by id";
	$rs = $conn->query($sql);
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"consumertype" => $data
	));

?>