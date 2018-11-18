<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['loandetails'];
	$data = json_decode($info);
	
	$loan_ac_id = $data->loan_ac_id;
	$g_father_name = $data->g_father_name;
	$father_name=$data->father_name;
	$applied_loan_amount = $data->applied_loan_amount;
	$loan_purpose =$data->loan_purpose;
	$approved_amount=$data->approved_amount;
	$loan_approved_date_bs=$data->loan_approved_date_bs;
	$loan_approved_date_ad=$data->loan_approved_date_ad;
	$loan_payment_date_bs=$data->loan_payment_date_bs;
	$loan_payment_date_ad=$data->loan_payment_date_ad;
	$interest_per=$data->interest_per;
	$interest_type_id = $data->interest_type_id;
	$payment_type_id = $data->payment_type_id;
	$loan_commitee_approver = $data->loan_commitee_approver;
	$managing_commitee_approver = $data->managing_commitee_approver;

	
	// $loan_ac_id = $_REQUEST['loan_ac_id'];
	// $g_father_name = $_REQUEST['g_father_name'];
	// $father_name=$_REQUEST['father_name'];
	// $applied_loan_amount = $_REQUEST['applied_loan_amount'];
	// $loan_purpose =$_REQUEST['loan_purpose'];
	// $approved_amount=$_REQUEST['approved_amount'];
	// $loan_approved_date_bs=$_REQUEST['loan_approved_date_bs'];
	// $loan_approved_date_ad=$_REQUEST['loan_approved_date_ad'];
	// $loan_payment_date_bs=$_REQUEST['loan_payment_date_bs'];
	// $loan_payment_date_ad=$_REQUEST['loan_payment_date_ad'];
	// $interest_per=$_REQUEST['interest_per'];
	// $interest_type_id = $_REQUEST['interest_type_id'];
	// $payment_type_id = $_REQUEST['payment_type_id'];
	// $loan_commitee_approver = $_REQUEST['loan_commitee_approver'];
	// $managing_commitee_approver = $_REQUEST['managing_commitee_approver'];

	
	
	$sql ="select * from acmaster where id ='".$loan_ac_id."'";
	$rs = $conn->query($sql);
	$r = mysqli_fetch_assoc($rs);
	$loan_ac_desc = $r['accountDesc'];

	$sql ="select * from interest_type where id ='".$interest_type_id."'";
	$rs = $conn->query($sql);
	$r = mysqli_fetch_assoc($rs);
	$interest_type = $r['interest_type'];

	$sql ="select * from loan_payment_type where id ='".$payment_type_id."'";
	$rs = $conn->query($sql);
	$r = mysqli_fetch_assoc($rs);
	$payment_type = $r['payment_type'];

	


	//consulta sql
	$query = sprintf("INSERT INTO loan_detail (loan_ac_id, g_father_name, father_name, applied_loan_amount, loan_purpose, approved_amount, loan_approved_date_bs, loan_approved_date_ad, loan_payment_date_bs, loan_payment_date_ad, interest_per,interest_type_id ,payment_type_id, loan_commitee_approver,  managing_commitee_approver ) values ('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d','%d','%d')",
		$conn->real_escape_string($loan_ac_id),
		$conn->real_escape_string($g_father_name),
		$conn->real_escape_string($father_name),
		$conn->real_escape_string($applied_loan_amount),
		$conn->real_escape_string($loan_purpose),
		$conn->real_escape_string($approved_amount),
		$conn->real_escape_string($loan_approved_date_bs),
		$conn->real_escape_string($loan_approved_date_ad),
		$conn->real_escape_string($loan_payment_date_bs),
		$conn->real_escape_string($loan_payment_date_ad),
		$conn->real_escape_string($interest_per),
		$conn->real_escape_string($interest_type_id),
		$conn->real_escape_string($payment_type_id),
		$conn->real_escape_string($loan_commitee_approver),
		$conn->real_escape_string($managing_commitee_approver)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"loandetails" => array(
			"id"=> mysqli_insert_id($conn),
			"loan_ac_id" => $loan_ac_id,
			"g_father_name" => $g_father_name,
			"father_name"=>$father_name,
			"applied_loan_amount"=>$applied_loan_amount,
			"loan_purpose"=>$loan_purpose,
			"approved_amount"=>$approved_amount,
			"loan_approved_date_bs"=>$loan_approved_date_bs,
			"loan_approved_date_ad"=>$loan_approved_date_ad,
			"loan_payment_date_bs"=>$loan_payment_date_bs,
			"loan_payment_date_ad"=>$loan_payment_date_ad,
			"interest_per"=>$interest_per,
			"interest_type_id"=>$interest_type_id,
			"payment_type_id"=>$payment_type_id,
			"loan_commitee_approver"=>$loan_commitee_approver,
			"managing_commitee_approver"=>$managing_commitee_approver,
			"loan_ac_desc" =>$loan_ac_desc,
	        "interest_type" =>$interest_type,
	        "payment_type" =>$payment_type
		)
	));
?>