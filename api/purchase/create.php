<?php
	include("../../includes/conectar.php");
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];

	$aliasName = $_REQUEST['aliasName'];
	$rate = $_REQUEST['rate'];
	$qty = $_REQUEST['qty'];
	$amount = $_REQUEST['amount'];
	$unitId = $_REQUEST['unitId'];
	$purchase_date_bs = $_REQUEST['purchase_date_bs'];
	$purchase_date_ad = $_REQUEST['purchase_date_ad'];
	$purchase_from = $_REQUEST['purchase_from'];
	$discount_rate = $_REQUEST['discount_rate'];
	$discount_amount = $_REQUEST['discount_amount'];
	$net_amount = $_REQUEST['net_amount'];
	$ref_no = $_REQUEST['ref_no'];
	$ref_date = $_REQUEST['ref_date'];
	$purchase_order_no = $_REQUEST['purchase_order_no'];
	
	

	if(is_null($discount_rate) || ($discount_rate=='')){
		$discount_rate=0;
	}
	if(is_null($discount_amount) || ($discount_amount=='')){
		$discount_amount=0;
	}
	if(is_null($net_amount) || ($net_amount=='')){
		$net_amount=0;
	}
	if(is_null($purchase_order_no) || ($purchase_order_no=='')){
		$purchase_order_no=0;
	}
	
	$status=1;
	$sql ="select * from inv_item where alias_name='".$aliasName."'";
	$rs = $conn->query($sql);
	$r = mysqli_fetch_assoc($rs);
	$itemId = $r['id'];
	$purchaseAccount = $r['PurchaseAccount'];
	$unit_id=$r['unit_id'];
	if($unit_id == $unitId){
		$perUnit = 1;	
	}else{
		$perUnit = $r['perUnit'];
	}
	
	$real_purchase_qty = $qty / $perUnit;
	

	$qry="select * from acmaster where accountNo='".$purchaseAccount."'";
	$rs = $conn->query($qry);
	$r = mysqli_fetch_assoc($rs);
	$account= $r['accountNo'].'  '.$r['accountDesc'];

	$insertSql = sprintf("insert into stock (fiscalYear, sourceCodeId, entryNo, itemId, rate, qty, amount, purchase_date_bs, purchase_date_ad, status, purchase_from, entry_date_bs, entry_date_ad, qty_in, unitId, discount_rate,discount_amount, net_amount,ref_no, ref_date, purchase_order_no) values ('%s','%d','%s','%d','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%d','%s','%s','%s','%s','%s','%s')",
		$conn->real_escape_string($fiscalYear),
		$conn->real_escape_string($sourceCodeId),
		$conn->real_escape_string($entryNo),
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($purchase_date_bs),
		$conn->real_escape_string($purchase_date_ad),
		$conn->real_escape_string($status),
		$conn->real_escape_string($purchase_from),
		$conn->real_escape_string($purchase_date_bs),
		$conn->real_escape_string($purchase_date_ad),
		$conn->real_escape_string($real_purchase_qty),
		$conn->real_escape_string($unitId),
		$conn->real_escape_string($discount_rate),
		$conn->real_escape_string($discount_amount),
		$conn->real_escape_string($net_amount),
		$conn->real_escape_string($ref_no),
		$conn->real_escape_string($ref_date),
		$conn->real_escape_string($purchase_order_no)
	);
	$conn->query($insertSql);
echo json_encode(array(
	"success" => mysqli_connect_errno() == 0,
	"purchaseAccount" => $purchaseAccount,
	"account"=>$account,
	"qry" => $insertSql
));
?>