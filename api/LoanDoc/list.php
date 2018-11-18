<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$loan_ac_id = $_REQUEST['loan_ac_id'];
	$cr ="";
	if(!is_null($loan_ac_id)){
		$cr = " where ld.loan_ac_id='".$loan_ac_id."'";
	}

	$queryString = "SELECT ld.*,  k.kagjatname from loan_doc ld left join loan_detail ldtl on ld.loan_ac_id = ldtl.id left join kagjatname k on ld.doc_type = k.id".$cr;

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
		"loandoc" => $data,
		"query" =>$queryString
	));
?>