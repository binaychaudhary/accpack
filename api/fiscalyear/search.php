<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//$conn->query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$fiscalyear=$_REQUEST['fiscalyear'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where status = '".$status . "'";
	}
	if(is_null($fiscalyear)||($fiscalyear=="")){
	}else{
		if($cr==""){
			$cr=" where fiscalyear like '%".$fiscalyear . "%'";
		}else{
			$cr = $cr." and fiscalyear like '%".$fiscalyear . "%'";
		}
	}
	
	$queryString = "SELECT * from fiscalyear ".$cr." LIMIT $start,  $limit";
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
		"fiscalyears" => $data
	));
?>