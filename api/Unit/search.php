<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$Unit=$_REQUEST['Unit'];
	$ShortName=$_REQUEST['ShortName'];
	$cr="";
	
	if(is_null($Unit)||($Unit=="")){
	}else{
		if($cr==""){
			$cr=" where u.Unit like '".$Unit . "%'";
		}else{
			$cr = $cr." and u.Unit like '".$Unit . "%'";
		}
	}
	if(is_null($ShortName) || ($ShortName=="")){
	}else{
		if($cr==""){
			$cr=" where u.ShortName like '".$ShortName . "%'";
		}else{
			$cr = $cr." and u.ShortName like '".$ShortName . "%'";
		}
	}
	
	$queryString = "SELECT u.* FROM unit u ".$cr;
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
		"units" => $data,
		"queryString" => $queryString
	));
?>