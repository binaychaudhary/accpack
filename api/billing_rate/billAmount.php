<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$unit = $_REQUEST['unit'];
	$queryString = "select * from billing_rate where unit_upto>$unit order by id limit 1";

	//echo $queryString;
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());
	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	$dat = mysqli_fetch_assoc($query);
	//print_r($dat);
	$fixAmount = $dat['fixed'];
	$calcAmount = ($unit - $dat['from_unit'])*$dat['rate'];
	$amt = $fixAmount+$calcAmount;

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"billCharge" => $amt,
		"rate_id" => $dat['id']
	));
?>