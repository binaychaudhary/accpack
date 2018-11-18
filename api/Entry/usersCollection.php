<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//$fiscalyear=$_REQUEST['fiscalyear'];
	$sourceCodeId=5;
	$userId=$_REQUEST['userId'];
	$from_date_ad=$_REQUEST['from_date_ad'];
	$upto_date_ad=$_REQUEST['upto_date_ad'];
	if((is_null($userId)) || ($userId=="")){
		$cr=" where e.userId='6'";
	}else{
		$cr=" where e.userId='".$userId."'";	
	}
	
	if(is_null($sourceCodeId)||($sourceCodeId=="")){
	}else{
		$cr = $cr." and e.sourceCodeId= '".$sourceCodeId."'";
	}
	if(is_null($from_date_ad)||($from_date_ad=="")){
	}else{
		$cr = $cr." and e.entry_date_ad>= '".$from_date_ad." 00:00:00'";
	}
	if(is_null($upto_date_ad)||($upto_date_ad=="")){
	}else{
		$cr = $cr." and e.entry_date_ad<= '".$upto_date_ad." 23:59:59'";
	}

	$queryString = "SELECT e.entryNo,e.amount from entry e  left join tmpentry te on e.sourceCodeId=te.sourceCodeId and e.fiscalyear = te.fiscalyear and e.entryNo = te.entryNo and te.accountNo='80.01-01'".$cr ;
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
		"usercollection" => $data,
		//"query" =>$queryString
	));
?>