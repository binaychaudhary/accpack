<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['crpayschedules'];

	// $data = json_decode($info);
	
	// $loan_amount = $data->loan_amount;
	// $no_of_installment=$data->no_of_installment;
	// $interest_type=$data->interest_type;
	// $installment_period=$data->installment_period;
	// $installment_start_date_bs=$data->installment_start_date_bs;
	// $installment_start_date_ad=$data->installment_start_date_ad;

	$loan_amount = $_REQUEST['loan_amount'];
	$no_of_installment=$_REQUEST['no_of_installment'];
	$interest_type=$_REQUEST['interest_type'];
	$installment_period=$_REQUEST['installment_period'];
	$interest_rate=$_REQUEST['interest_rate'];
	$installment_start_date_bs=$_REQUEST['installment_start_date_bs'];
	$installment_start_date_ad=$_REQUEST['installment_start_date_ad'];

	$query1 = "INSERT INTO installment_schedule (loan_amount,no_of_installment,interest_type,installment_period,installment_start_date_bs,installment_start_date_ad) values ('$loan_amount','$no_of_installment','$interest_type','$installment_period','$installment_start_date_bs','$installment_start_date_ad')";
	// 	mysql_real_escape_string($loan_amount),
	// 	mysql_real_escape_string($no_of_installment),
	// 	mysql_real_escape_string($interest_type),
	// 	mysql_real_escape_string($installment_period),
	// 	mysql_real_escape_string($installment_start_date_bs),
	// 	mysql_real_escape_string($installment_start_date_ad)
	// );

	$rs = $conn->query($query1);

		
		$id=mysqli_insert_id($conn);

	if($interest_type==1){
		$interest_amount=(($loan_amount* $interest_rate/100)/$installment_period)*$no_of_installment;
		$total_installment=($loan_amount+$interest_amount);
		$loan_installment=$loan_amount/$no_of_installment;
		$per_installment=$total_installment/$no_of_installment;
		
		for($i=1;$i<=$no_of_installment;$i++){

			$query = "INSERT INTO installment_details (schedule_id,installment_no,loan_amount,interest_rate,interest_amount,loan_installment,total_installment) values ('$id','$i','$loan_amount','$interest_rate','$interest_amount','$loan_installment','$total_installment')";
			
			$rs = $conn->query($query);
		}
	}
	if($interest_type==2){
 		for($i=1;$i<=$no_of_installment;$i++){
 			//$i=$i+1;
 			$loan_installment=$loan_amount/$no_of_installment;
 			$interest=($loan_amount* $interest_rate/100);
 			$one_installment_interest=$interest/$no_of_installment;
 			$per_installment=$interest+$one_installment_interest;
 			$total_installment=($loan_amount+$one_installment_interest);
 			$query = "INSERT INTO installment_details (schedule_id,installment_no,loan_amount,interest_rate,interest_amount,loan_installment,total_installment) values ('$id','$i','$loan_amount','$interest_rate','$one_installment_interest','$loan_installment','$total_installment')";
			
			$rs = $conn->query($query);
			$loan_amount=$loan_amount-$loan_installment;
 		}
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"crpayschedules" => array(
			"id" => $id,
			"loan_amount" => $loan_amount,
			"no_of_installment"=>$no_of_installment,
			"installment_period" => $installment_period,
			"installment_period" => $installment_period,
			"installment_start_date_bs"=>$installment_start_date_bs,
			"installment_start_date_ad"=>$installment_start_date_ad,
			"q"=>$query
		)
	));
?>