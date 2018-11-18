<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$report_from = $_REQUEST['report_from'];
	
	//processing alya stock
	$sql="select COALESCE(sum(qty_in),0)-COALESCE(sum(qty_out),0) as qty  from stock where itemId='$itemId' and entry_date_ad<'$report_from'";
	//echo $sql;
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

	//encoda para formato JSON
	echo json_encode(array(
		"opening_qty" => $alya_qty,
		"opening_amount" => $alya_amount
	));
?>