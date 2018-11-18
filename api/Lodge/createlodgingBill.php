<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	

	$guest_id=$_REQUEST['guest_id'];
	$bill_date_bs=$_REQUEST['bill_date_bs'];
	$bill_date_ad=$_REQUEST['bill_date_ad'];
	


	//consulta sql
	$sql="insert into lodging_bill(guest_id,bill_date_bs,bill_date_ad) values('$guest_id','$bill_date_bs','$bill_date_ad')";
	$rs=$conn->query($sql);
	$bill_id=mysqli_insert_id($conn);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
			"id" => $bill_id,
			"bill_id"=>$bill_id,
			"guest_id" => $guest_id,
			"bill_date_bs" => $bill_date_bs,
			"bill_date_ad" => $bill_date_ad,
			"q"=>$sql
	));
?>