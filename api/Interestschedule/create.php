<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['interestschedules'];

	$data = json_decode($info);
	$accountNo = $_REQUEST['accountNo'];
	$loan_detail_id=$_REQUEST['loan_detail_id'];
	$loan_detail_id=$_REQUEST['loan_amount'];
	$installment_start_date_bs = $_REQUEST['installment_start_date_bs'];
	$installment_start_date_ad = $_REQUEST['installment_start_date_ad'];
	$no_of_installment = $_REQUEST['payment_status'];

	
	//consulta sql
	$query = sprintf("INSERT INTO interest_schedule (accountNo, loan_detail_id, installment_start_date_bs, installment_start_date_ad, loan_amount, no_of_installment) values ('%s','%s','%s,'%s','%s','%s')",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($loan_detail_id),
		$conn->real_escape_string($installment_start_date_bs),
		$conn->real_escape_string($installment_start_date_ad),
		$conn->real_escape_string($loan_amount),
		$conn->real_escape_string($no_of_installment)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"interestschedules" => array(
			"id" => mysqli_insert_id($conn),
			"accountNo"=>$accountNo,
			"loan_detail_id" => $loan_detail_id,
			"installment_start_date_bs" => $installment_start_date_bs,
			"installment_start_date_ad"=>$installment_start_date_ad,
			"loan_amount"=>$loan_amount,
			"no_of_installment"=>$no_of_installment
		)
	));
?>