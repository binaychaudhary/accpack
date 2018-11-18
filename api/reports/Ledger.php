<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$queryString = "SELECT * FROM Ledger";
	//echo "<br>".$queryString."<br>";
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
	    $data[] = $dat;
	}

	//consulta total de linhas na tabela
	$queryTotal = $conn->query('SELECT count(*) as num FROM Ledger') or die(mysqli_connect_error());
	$row = mysqli_fetch_assoc($queryTotal);
	$total = $row['num'];

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $total,
		"Ledger" => $data
	));
?>