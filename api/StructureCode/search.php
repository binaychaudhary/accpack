<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$StructureCode=$_REQUEST['StructureCode'];
	$Description=$_REQUEST['Description'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where status = '".$status . "'";
	}
	if(is_null($StructureCode)||($StructureCode=="")){
	}else{
		if($cr==""){
			$cr=" where StructureCode like '%".$StructureCode . "%'";
		}else{
			$cr = $cr." and StructureCode like '%".$StructureCode . "%'";
		}
	}
	if(is_null($Description)||($Description=="")){
	}else{
		if($cr==""){
			$cr=" where Description like '%".$Description . "%'";
		}else{
			$cr = $cr." and Description like '%".$Description . "%'";
		}
	}
	$queryString = "SELECT * from structurecode ".$cr." LIMIT $start,  $limit";
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
		"structurecodes" => $data
	));
?>