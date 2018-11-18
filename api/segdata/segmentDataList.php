<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$segment_id=$_REQUEST['segment_id'];
	$segment_code=$_REQUEST['segment_code'];
	$name_np=$_REQUEST['name_np'];
	$name_en=$_REQUEST['name_en'];
	$cr="";
	//echo "<br>".$name_np;
	$cr=" where segment_id='".$segment_id."'";
	if(is_null($segment_code)||($segment_code=="")){
	}else{
		if($cr==""){
			$cr=" where segment_code like '%".$segment_code. "%'";
		}else{
			$cr = $cr." and segment_code like '%".$segment_code. "%'";
		}
	}
	if(is_null($name_np)||($name_np=="")){
	}else{
		if($cr==""){
			$cr=" where name_np like '%".$name_np . "%'";
		}else{
			$cr = $cr." and name_np like '%".$name_np . "%'";
		}
	}
	if(is_null($name_en)||($name_en=="")){
	}else{
		if($cr==""){
			$cr=" where name_en like '%".$name_en . "%'";
		}else{
			$cr = $cr." and name_en like '%".$name_en . "%'";
		}
	}
	//echo "<br>".$cr;
	$queryString = "SELECT * FROM segmentData ".$cr." LIMIT $start,  $limit";
	//echo "<br>".$queryString."<br>";
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$segments = array();
	while($segment = mysqli_fetch_assoc($query)) {
	    $segments[] = $segment;
	}

	//consulta total de linhas na tabela
	$queryTotal = $conn->query('SELECT count(*) as num FROM segmentData'.$cr) or die(mysqli_connect_error());
	$row = mysqli_fetch_assoc($queryTotal);
	$total = $row['num'];

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $total,
		"segmentdatas" => $segments
	));
?>