<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$fiscalyear=$_REQUEST['fiscalyear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];
	$approvalStatus=$_REQUEST['approvalStatus'];
	$printStatus=$_REQUEST['printStatus'];
	
	$cr=" where e.sourceCodeId='".$sourceCodeId."'";

	if(is_null($fiscalyear)||($fiscalyear=="")){
	}else{
		$cr = $cr." and e.fiscalyear = '".$fiscalyear."'";
	}

	if(is_null($entryNo)||($entryNo=="")){
	}else{
		$cr = $cr." and e.entryNo like '%".$entryNo."%'";
	}

	if(is_null($approvalStatus)||($approvalStatus=="")){
	}else{
		$cr = $cr." and e.approvalStatus = '".$approvalStatus."'";
	}
	if(is_null($printStatus)||($printStatus=="")){
	}else{
		$cr = $cr." and e.printStatus = '".$printStatus."'";
	}
	$queryString = "SELECT e.*, sc.sourceCode from entry e left join sourcecode sc on e.sourceCodeId = sc.id  ".$cr." order by entry_date_ad desc, entryNo desc" ;
	//consulta sql
	//echo $queryString;
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
		"entries" => $data,
		"query" =>$queryString
	));
?>