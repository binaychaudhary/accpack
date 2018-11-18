<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$name=$_REQUEST['name'];
	$positionId=$_REQUEST['positionId'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where u.status = '".$status . "'";
	}
	if(is_null($name)||($name=="")){
	}else{
		if($cr==""){
			$cr=" where u.name like '%".$name . "%'";
		}else{
			$cr = $cr." and u.name like '%".$name . "%'";
		}
	}
	if(is_null($posotionId)||($positionId=="")){
	}else{
		if($cr==""){
			$cr=" where u.positionId = '".$positionId . "'";
		}else{
			$cr = $cr." and u.positionId = '".$positionId . "'";
		}
	}
	
	$queryString = "SELECT u.*, p.position FROM rinsamiti u left join credit_post p on u.positionId=p.id ".$cr." LIMIT $start,  $limit";
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
		"rinsamitis" => $data
	));
?>