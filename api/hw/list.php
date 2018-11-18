<?php
	include("../../includes/conectar.php");
	
	$sql ="select * from hw";
	$rs = $conn->query($cr);

	$data = array();
	$cnt=0;
	while($dat = mysqli_fetch_assoc($rs)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"hws" => $data
	));
?>