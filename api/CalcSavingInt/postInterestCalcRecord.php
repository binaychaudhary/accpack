<?php
	
	$accountNo=$_REQUEST['accountNo'];
	$calcDateBs=$_REQUEST['calcDateBs'];
	$calcDateAd=$_REQUEST['calcDateAd'];
	$intRate = $_REQUEST['intRate'];
	$created_by=$_REQUEST['created_by'];
	$fiscalYear=$_REQUEST['fiscalYear'];
	$taxRate=$_REQUEST['taxRate'];
	$intAmount = $_REQUEST['intAmount'];
	$taxAmount = $_REQUEST['taxAmount'];

	$query = "insert into int_calc_record(accountNo";
		$query=$query.", calcDateBs";
		$query=$query.", calcDateAd";
		$query=$query.", intRate";
		$query=$query.", created_by";
		$query=$query.", fiscalYear";
		$query=$query.", taxRate";
		$query=$query.", intAmount";
		$query=$query.", taxAmount)";
		$query=$query."values(";
		$query=$query."'$accountNo'";
		$query=$query.",'$calcDateBs'";
		$query=$query.",'$calcDateAd'";		
		$query=$query.",'$intRate'";
		$query=$query.",'$created_by'";
		$query=$query.",'$fiscalYear'";
		$query=$query.",'$taxRate'";
		$query=$query.",'$intAmount'";
		$query=$query.",'$taxAmount')";
	include("../../includes/conectar.php");
	$conn->query($query);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"query"=> $query
	));
?>