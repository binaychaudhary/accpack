<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['loancollaterals'];

	$data = json_decode($info);
	$id=$data->id;
	 
	$loan_id = $data->loan_id;
	$accountNo = $data->accountNo;
	$agreedAmount=$data->agreedAmount;
	$status=$data->status;
	
	$rs=$conn->query("select * from acmaster where id='".$accountNo."'");
	$r=mysqli_fetch_assoc($rs);
	$accountDesc=$r['accountDesc'];
	$acNo = $r['accountNo'];
	//consulta sql
	$query = sprintf("UPDATE loan_collateral SET loan_id = '%d', accountNo = '%s', agreedAmount='%s', status='%d' WHERE id=%d",
		$conn->real_escape_string($loan_id),
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($agreedAmount),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"loancollaterals" => array(
			"id" => $id,
			"loan_id" => $loan_id,
			"accountNo"=>$accountNo,
			"agreedAmount" => $agreedAmount,
			"status" => $status,
			"accountDesc"=>$accountDesc
		)
	));
?>