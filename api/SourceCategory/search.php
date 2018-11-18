<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$category=$_REQUEST['category'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where s.status = '".$status . "'";
	}
	if(is_null($category)||($category=="")){
	}else{
		if($cr==""){
			$cr=" where s.category like '".$category . "%'";
		}else{
			$cr = $cr." and s.category like '".$category . "%'";
		}
	}
	
	$queryString = "SELECT * from sourcecodecategory ".$cr." LIMIT $start,  $limit";
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
		"sourcecategorys" => $data
	));
?>