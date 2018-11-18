<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];


	$queryString = "SELECT c.*, a.accountDesc, u.userName from chequeprint c left join acmaster a on c.accountNo = a.accountNo left join user u on c.printedBy = u.id  order by printedDateAd desc LIMIT $start,  $limit";

	//consulta sql
	$query =$conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"chequeprints" => $data
	));
?>