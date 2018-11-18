<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$loan_id = $_REQUEST['loan_id'];
	$cr ="";
	if(!is_null($loan_id)){
		$cr = " where lc.loan_id='".$loan_id."'";
	}

	$queryString = "SELECT lc.*, am.accountDesc, am.accountNo as acNo from loan_collateral lc left join acmaster am on lc.accountNo = am.id".$cr;

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

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
		"loancollaterals" => $data
	));
?>