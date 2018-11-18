<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	
	$queryString = "SELECT g.*, sg.subGroupName as subGroupDesc, sg.subGroupCode, mp.periodDesc as matureType from groupintrate g left join subgroup sg on g.subgroupId=sg.id left join maturePeriod mp on g.matureTypeId = mp.id  LIMIT $start,  $limit";
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
		"qry" => $queryString,
		"groupsavingintrates" => $data
	));
?>