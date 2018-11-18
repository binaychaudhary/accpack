<?php
	//chama o arquivo de conexão com o bd
	include("conectar.php");
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCode = $_REQUEST['sourceCode'];

	//consulta sql

	$rsSourceCode=$conn->query("select * from sourcecode where id='".$sourceCode."'");
	$r=mysqli_fetch_assoc($rsSourceCode);
	$sourceCodeId=$r['id'];
	$codeLength=$r['codeLength'];
	if($sourceCode==6){
		$sql ="select max(entryNo) as maxEntryNo from stock where fiscalYear='".$fiscalYear."' and sourceCodeId='".$sourceCode."'";
	}else{
		$sql ="select max(entryNo) as maxEntryNo from tmpentry where fiscalyear='".$fiscalYear."' and sourceCodeId='".$sourceCode."'";
	}

	$rs = $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$maxEntryNo = $r['maxEntryNo']+1;

	$entryNo=substr("000000000".$maxEntryNo,-$codeLength);
	
	echo json_encode(array(
		"newEntryNo" => $entryNo
	));
?>