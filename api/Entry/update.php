<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['entries'];

	$data = json_decode($info);
	$id=$data->id;
	$fiscalyear = $data->fiscalyear;
	$userId = $data->userId;
	$sourceCodeId=$data->sourceCodeId;
	$amount = $data->amount;
	$entryNo =$data->entryNo;
	$entry_date_bs=$data->entry_date_bs;
	$entry_date_ad=$data->entry_date_ad;
	
	$sql = "select * from sourcecode where id ='" .$sourceCodeId."'";
	$rs=$conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$sourceCode = $r['sourceCode'];
	}
	//consulta sql
	$query = sprintf("UPDATE entry SET entry_date_bs = '%s', entry_date_ad = '%s', amount='%d', approvalStatus='%d', approvedBy='%d', approvedDate='%s' WHERE id=%d",
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad),
		$conn->real_escape_string($amount),
		0,
		0,
		null,
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"entries" => array(
			"id" => $id,
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