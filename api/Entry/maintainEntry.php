<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	
	$fiscalyear = $_REQUEST['fiscalyear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo =$_REQUEST['entryNo'];
	$amount = $_REQUEST['amount'];
	$entry_date_bs=$_REQUEST['dateBs'];
	$entry_date_ad=$_REQUEST['dateAd'];
	$inWords=$_REQUEST['inWords'];
	$sql =sprintf("select * from entry where fiscalyear='%s' and sourceCodeId='%d' and entryNo='%s'",
		$conn->real_escape_string($fiscalyear),
		$conn->real_escape_string($sourceCodeId),
		$conn->real_escape_string($entryNo)
		);

	$rs=$conn->query($sql);
	if(mysqli_num_rows($rs)>0 ){
		$sql=sprintf("update entry set amount='%s', amountInWord='%s', entry_date_bs='%s', entry_date_ad='%s' where fiscalyear='%s' and sourceCodeId='%d' and entryNo='%s'",
			$conn->real_escape_string($amount),
			$conn->real_escape_string($inWords),
			$conn->real_escape_string($entry_date_bs),
			$conn->real_escape_string($entry_date_ad),
			$conn->real_escape_string($fiscalyear),
			$conn->real_escape_string($sourceCodeId),
			$conn->real_escape_string($entryNo)
			);
	}else{
		$sql=sprintf("insert into entry(fiscalyear, sourceCodeId, entryNo, amount, amountInWord, entry_date_bs, entry_date_ad,approvalStatus, printStatus) values('%s', '%d', '%s', '%s','%s', '%s', '%s', '%d', '%d')",
			$conn->real_escape_string($fiscalyear),
			$conn->real_escape_string($sourceCodeId),
			$conn->real_escape_string($entryNo),
			$conn->real_escape_string($amount),
			$conn->real_escape_string($inWords),
			$conn->real_escape_string($entry_date_bs),
			$conn->real_escape_string($entry_date_ad),0,0
			);
	}

	$rs = $conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sql" => $sql
	));
?>