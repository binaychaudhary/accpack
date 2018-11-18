<?php
	include("../../includes/conectar.php");
	$from_date_ad = $_REQUEST['from_date_ad'];
	$upto_date_ad = $_REQUEST['upto_date_ad'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];

	$sql="select e.*, a.accountDesc as customer  from entry e left join acmaster a on e.sales_to = a.accountNo where e.sourceCodeId='$sourceCodeId' and e.entry_date_ad >= '$from_date_ad' and e.entry_date_ad <= '$upto_date_ad' order by e.entry_date_ad";
	//echo $sql;

	$query = $conn->query( $sql) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$totalAmount=0;
	$toalSalesAmt=0;
	$totalVat=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	    $totalAmount=$totalAmount + $dat['amount'];
	    $toalSalesAmt=$toalSalesAmt + $dat['sales_amt'];
	    $totalVat=$totalVat + $dat['vat'];
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"salesdaybooks" => $data,
		"totalAmount"=>$totalAmount,
		"toalSalesAmt"=>$toalSalesAmt,
		"totalVat"=>$totalVat
	));
	
?>