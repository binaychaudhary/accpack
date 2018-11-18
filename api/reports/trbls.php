<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$queryString = "SELECT * from trialbalance";

	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"trialbalances" => $data
	));
?>