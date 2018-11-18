<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	 $info = $_POST['loancollaterals'];
	 $data = json_decode($info);

	$loan_id = $data->loan_id;
	$accountNo = $data->accountNo;
	$agreedAmount=$data->agreedAmount;
	$status=$data->status;

	

	// $loan_id = $_REQUEST['loan_id'];
	// $accountNo = $_REQUEST['accountNo'];
	// $agreedAmount=$_REQUEST['agreedAmount'];

	$rs=$conn->query("select * from acmaster where id='".$accountNo."'");
	$r=mysqli_fetch_assoc($rs);
	$accountDesc=$r['accountDesc'];
	$acNo=$r['accountNo'];

	
	//consulta sql
	$query = sprintf("INSERT INTO loan_collateral(loan_id, accountNo, agreedAmount, status) values ('%d','%d','%s','%d')",
		$conn->real_escape_string($loan_id),
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($agreedAmount),
		$conn->real_escape_string($status)
	);
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"loancollaterals" => array(
			"id" => mysqli_insert_id($conn),
			"loan_id" => $loan_id,
			"accountNo"=>$accountNo,
			"agreedAmount" => $agreedAmount,
			"status" => $status,
			"accountDesc"=>$accountDesc,
			"acNo" => $acNo
		)
	));
?>