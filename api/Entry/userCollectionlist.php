<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$userId = $_REQUEST['userId'];
	
	$entry_date_ad = $_REQUEST['entry_date_ad'];
	$upto_date_ad = $_REQUEST['upto_date_ad'];
	$cr="";
	$sourceCodeId="5";
	if(is_null($sourceCodeId) || ($sourceCodeId=="")){
	}else{
	
		if($cr==""){
			$cr = " where e.sourceCodeId = '".$sourceCodeId."'";
		}else{
			$cr = $cr." and e.sourceCodeId  = '".$sourceCodeId."'";
		}
	}
	
	if(is_null($userId) || ($userId=="")){
	}else{
	
		if($cr==""){
			$cr = " where e.userId = '".$userId."'";
		}else{
			$cr = $cr." and e.userId  = '".$userId."'";
		}
	}

	if(is_null($entry_date_ad) || ($entry_date_ad=="")){
	}else{
	
		if($cr==""){
			$cr = " where e.entry_date_ad >= '".$entry_date_ad." 00:00:00'";
		}else{
			$cr = $cr." and e.entry_date_ad  >= '".$entry_date_ad." 00:00:00'";
		}
	}
	if(is_null($upto_date_ad) || ($upto_date_ad=="")){
	}else{
	
		if($cr==""){
			$cr = " where e.entry_date_ad <= '".$upto_date_ad." 23:59:59'";
		}else{
			$cr = $cr." and e.entry_date_ad  <= '".$upto_date_ad." 23:59:59'";
		}
	}
	$accountNo='80.01-01';
	if(is_null($accountNo) || ($accountNo=="")){
	}else{
	
		if($cr==""){
			$cr = " where te.accountNo = '".$accountNo."'";
		}else{
			$cr = $cr." and te.accountNo  = '".$accountNo."'";
		}
	}
	$queryString = "SELECT te.debit as amount,e.entryNo,e.entry_date_bs from entry e";
	
	$queryString.= " left join tmpentry te on te.sourceCodeId = e.sourceCodeId and e.entryNo=te.entryNo and e.fiscalyear=te.fiscalyear".$cr;
	 $queryString.= " order by te.entryNo,e.entry_date_bs";

	 // SELECT te.debit as amount,e.entryNo,e.entry_date_bs from entry e left join tmpentry te on te.sourceCodeId = e.sourceCodeId and e.entryNo=te.entryNo and e.fiscalyear=te.fiscalyear where e.sourceCodeId = '5' and e.userId  = '6' and e.entry_date_ad  >= '2017/04/28 00:00:00' and e.entry_date_ad  <= '2017/04/29 23:59:59' and te.accountNo  = '80.01-01' order by te.entryNo,e.entry_date_bs
	 

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	$totalAmount =0;


	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
		$totalAmount = $totalAmount + $dat['amount'];
	    $data[] = $dat;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"totalAmount" =>$totalAmount,
		"qry"=>$queryString,
		"collectionSummary" => $data,
		"q"=>$queryString
		//"dat" => $dat
	));
?>