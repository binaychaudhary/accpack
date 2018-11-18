<?php
	
	$accountNo=$_REQUEST['accountNo'];
	$calcDateBs=$_REQUEST['calcDateBs'];
	$calcDateAd=$_REQUEST['calcDateAd'];
	$created_by=$_REQUEST['created_by'];
	$fiscalYear=$_REQUEST['fiscalYear'];
	$loan_amount = $_REQUEST['loan_amount'];
	$intRate=$_REQUEST['intRate'];
	$intAmount = $_REQUEST['intAmount'];
	
	$query = "insert into loan_int_calc_record(accountNo";
		$query=$query.", calcDateBs";
		$query=$query.", calcDateAd";
		$query=$query.", created_by";
		$query=$query.", fiscalYear";
		$query=$query.", loan_amount";
		$query=$query.", intRate";
		$query=$query.", intAmount)";
		$query=$query."values(";
		$query=$query."'$accountNo'";
		$query=$query.",'$calcDateBs'";
		$query=$query.",'$calcDateAd'";	
		$query=$query.",'$created_by'";	
		$query=$query.",'$fiscalYear'";
		$query=$query.",'$loan_amount'";
		$query=$query.",'$intRate'";
		$query=$query.",'$intAmount')";
	include("../../includes/conectar.php");
	$conn->query($query);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"query"=> $query
	));
?>