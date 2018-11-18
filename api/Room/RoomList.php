<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	

	$queryString = "SELECT r.*, rt.rdescription ,b.bdescription,0 as status  from room r";
	$queryString.= " left join room_type rt on r.room_type_id = rt.id";
	$queryString.= " left join bed_type b on r.bed_type_id = b.id where r.status=1";
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
		"rooms" => $data,
		"q"=>$queryString
	));
?>