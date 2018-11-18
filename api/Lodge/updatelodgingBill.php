<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	

	$id=$_REQUEST['bill_id'];
	$amount=$_REQUEST['amount'];
	$amount_in_word=$_REQUEST['amountInWord'];
	


	//consulta sql
	$sql="update  lodging_bill set amount='$amount', amount_in_word='$amount_in_word' where id='$id'";
	$rs=$conn->query($sql);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,

			"id" => $id,
			"amount" => $amount,
			"amount_in_word" => $amount_in_word
		
	));
?>