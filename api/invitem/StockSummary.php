<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$report_from = $_REQUEST['report_from'];
	$report_upto = $_REQUEST['report_upto'];
	
	//processing alya stock
	$sql="select COALESCE(sum(qty_in),0)-COALESCE(sum(qty_out),0) as qty from stock where itemId='$itemId' and entry_date_ad<'$report_from'";
	$rs= $conn->query($sql);
	$alya_qty=0;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$alya_qty= $r['qty'];
	}
	//processing amount_in 
	$sql="select COALESCE(sum(amount),0) as amount_in from stock where itemId='$itemId' and qty_in>0 and entry_date_ad<'$report_from'";
	$rs= $conn->query($sql);
	$amount_in=0;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$amount_in= $r['amount_in'];
	}
	//processing amount_out 
	$sql="select COALESCE(sum(amount),0) as amount_out from stock where itemId='$itemId' and qty_out>0 and entry_date_ad<'$report_from'";
	$rs= $conn->query($sql);
	$amount_out=0;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$amount_out= $r['amount_out'];
	}
	$alya_amount=$amount_in - $amount_out;

	//calculating current period purchase
	$sql="select COALESCE(sum(qty_in),0) as qty_in,COALESCE(sum(qty_out),0) as qty_out from stock where itemId='$itemId' and entry_date_ad>='$report_from' and entry_date_ad<='$report_upto'";
	$rs= $conn->query($sql);
	$purchase_qty=0;
	$sales_qty=0;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$purchase_qty= $r['qty_in'];
		$sales_qty= $r['qty_out'];
	}
	//calculating purchase amount
	$sql="select COALESCE(sum(amount),0) as amount_in from stock where itemId='$itemId' and qty_in>0 and entry_date_ad>='$report_from' and entry_date_ad<='$report_upto'";
	$rs= $conn->query($sql);
	$purchase_amount=0;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$purchase_amount= $r['amount_in'];
	}
	//calculating sales amount
	$sql="select COALESCE(sum(amount),0) as amount_out from stock where itemId='$itemId' and qty_out>0 and entry_date_ad>='$report_from' and entry_date_ad<='$report_upto'";
	$rs= $conn->query($sql);
	$sales_amount=0;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$sales_amount= $r['amount_out'];
	}
	$balance_qty = $alya_qty + $purchase_qty - $sales_qty;
	$balance_amount =$alya_amount + $purchase_amount - $sales_amount;
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"alya_qty" => $alya_qty,
		"alya_amount" => $alya_amount,
		"purchase_qty" => $purchase_qty,
		"purchase_amount" => $purchase_amount,
		"sales_qty" => $sales_qty,
		"sales_amount" => $sales_amount,
		"balance_qty" => $balance_qty,
		"balance_amount" => $balance_amount
	));
?>