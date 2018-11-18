<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$name_np=$_REQUEST['name_np'];
	$name_en=$_REQUEST['name_en'];
	$cr="";
	//echo "<br>".$name_np;
	if(is_null($name_np)){
	}else{
		$cr=" where name_np like '%".$name_np . "%'";
	}
	if(is_null($name_en)){
	}else{
		if($cr==""){
			$cr=" where name_en like '%".$name_en . "%'";
		}else{
			$cr = $cr." and name_en like '%".$name_en . "%'";
		}
	}
	//echo "<br>".$cr;
	$queryString = "SELECT * FROM segment ".$cr." LIMIT $start,  $limit";
	//echo "<br>".$queryString."<br>";
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$segments = array();
	while($segment = mysqli_fetch_assoc($query)) {
	    $segments[] = $segment;
	}

	//consulta total de linhas na tabela
	$queryTotal = $conn->query('SELECT count(*) as num FROM segment'.$cr) or die(mysqli_connect_error());
	$row = mysqli_fetch_assoc($queryTotal);
	$total = $row['num'];

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $total,
		"segments" => $segments
	));
?>