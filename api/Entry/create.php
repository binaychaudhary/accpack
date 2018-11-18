<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['entries'];
	// $data = json_decode($info);
	
	$fiscalyear = $_REQUEST['fiscalyear'];
	$userId = $_REQUEST['userId'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$amount = $_REQUEST['amount'];
	$entryNo =$_REQUEST['entryNo'];
	$entry_date_bs=$_REQUEST['entry_date_bs'];
	$entry_date_ad=$_REQUEST['entry_date_ad'];

	// $fiscalyear = $data->fiscalyear;
	// $userId = $data->userId;
	// $sourceCodeId=$data->sourceCodeId;
	// $amount = $data->amount;
	// $entryNo =$data->entryNo;
	// $entry_date_bs=$data->entry_date_bs;
	// $entry_date_ad=$data->entry_date_ad;
	
	$sql = "select * from sourcecode where id ='" .$sourceCodeId."'";
	$rs=$conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$sourceCode = $r['sourceCode'];
	}
	//consulta sql
	$query = sprintf("INSERT INTO entry (fiscalyear, userId, sourceCodeId, entryNo, entry_date_bs, entry_date_ad  ) values ('%s','%d','%d','%s','%s','%s')",
		$conn->real_escape_string($fiscalyear),
		$conn->real_escape_string($userId),
		$conn->real_escape_string($sourceCodeId),
		$conn->real_escape_string($entryNo),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"entries" => array(
			"id"=> mysqli_insert_id($conn),
			"fiscalyear" => $fiscalyear,
			"userId" => $userId,
			"entryNo"=>$entryNo,
			"entry_date_bs"=>$entry_date_bs,
			"entry_date_ad"=>$entry_date_ad,
			"approvalStatus"=>false,
			"approvedBy"=>null,
			"approvedDate"=>null,
			"sourceCode"=>$sourceCode
		)
	));
?>