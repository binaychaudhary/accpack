<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	

	$bill_id=$_REQUEST['bill_id'];
	$room_id=$_REQUEST['room_id'];
	$days_stayed=$_REQUEST['days_stayed'];
	$amount=$_REQUEST['amount'];
	


	//consulta sql
	$sql="insert into lodging_bill_detail(bill_id,room_id,days_stayed,amount) values('$bill_id','$room_id','$days_stayed','$amount')";
	$rs=$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		
			"id" => mysqli_insert_id($conn),
			"bill_id" => $bill_id,
			"room_id" => $room_id,
			"days_stayed" => $days_stayed,
			"amount" =>$amount,
			"q"=>$sql
		
	));
?>