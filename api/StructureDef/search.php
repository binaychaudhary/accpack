<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$structureId=$_REQUEST['structureId'];
	$cr="";
	if(is_null($structureId)||($structureId=="")){
	}else{
		$cr=" where sdef.structureId = '".$structureId . "'";
	}
	
	$queryString = "SELECT sdef.*, seg.name_np as segmentDesc from structuredef sdef left join segment seg  on sdef.segmentId= seg.id ".$cr." LIMIT $start,  $limit";
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
		"structuredefs" => $data
	));
?>