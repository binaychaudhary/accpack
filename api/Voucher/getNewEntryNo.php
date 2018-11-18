<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];

	$rs=$conn->query("select * from sourcecode where id='".$sourceCodeId."'");
	$r=mysqli_fetch_assoc($rs);
	$codeLength=$r['codeLength'];
	$queryString = "SELECT * from tmpentry where fiscalYear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' order by entry_date_ad desc, entryNo desc, id desc limit 1";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_conect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	if(mysqli_num_rows($query)>0){
		while($dat = mysqli_fetch_assoc($query)) {
			$cnt=$cnt+1;
		    $data[] = $dat;
		    $newEntryNo=$dat['entryNo'];
		}
	}else{
		$newEntryNo=0;
	}
	$newEntryNo=(int)$newEntryNo+1;
	$newEntryNo = substr("00000000".$newEntryNo, -$codeLength);
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"newEntryNo"=>$newEntryNo,
		"voucherLength" => $codeLength
	));
?>