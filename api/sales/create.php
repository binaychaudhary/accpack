<?php
	include("../../includes/conectar.php");
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];

	$aliasName = $_REQUEST['aliasName'];
	$rate = $_REQUEST['rate'];
	$qty = $_REQUEST['qty'];
	$amount = $_REQUEST['amount'];
	$sales_date_bs = $_REQUEST['sales_date_bs'];
	$sales_date_ad = $_REQUEST['sales_date_ad'];
	$sales_to = $_REQUEST['sales_to'];
	$unitId = $_REQUEST['unitId'];
	$discount_rate = $_REQUEST['discount_rate'];
	$discount_amount = $_REQUEST['discount_amount'];
	$net_amount = $_REQUEST['net_amount'];
	$ref_no =$_REQUEST['ref_no'];
	$ref_date =$_REQUEST['ref_date'];
	$sales_order_no =$_REQUEST['sales_order_no'];


	if(is_null($discount_rate) || ($discount_rate=='')){
		$discount_rate=0;
	}
	if(is_null($discount_amount) || ($discount_amount=='')){
		$discount_amount=0;
	}
	if(is_null($net_amount) || ($net_amount=='')){
		$net_amount=0;
	}
	if(is_null($sales_order_no) || ($sales_order_no=='')){
		$sales_order_no=0;
	}

	$status=1;
	$sql ="select * from inv_item where alias_name='".$aliasName."'";
	$rs = $conn->query($sql);
	$r = mysqli_fetch_assoc($rs);
	$itemId = $r['id'];
	$groupId = $r['group_id'];
	$salesAccount = $r['SalesAccount'];
	$unit_id=$r['unit_id'];
	if($unit_id == $unitId){
		$perUnit = 1;	
	}else{
		$perUnit = $r['perUnit'];
	}
	$real_sales_qty = $qty / $perUnit;
	
	$qry="select * from acmaster where accountNo='".$salesAccount."'";
	$rs = $conn->query($qry);
	$r = mysqli_fetch_assoc($rs);
	$account= $r['accountNo'].'  '.$r['accountDesc'];

	//getting group ids
	$gSql="select * from inv_group where id ='".$groupId."'";
	$grs = $conn->query($gSql);
	$gr = mysqli_fetch_assoc($grs);
	$g1= $gr['g1'];
	$g2= $gr['g2'];
	$g3= $gr['g3'];
	$g4= $gr['g4'];
	$g5= $gr['g5'];
	$g6= $gr['g6'];
	$g7= $gr['g7'];

	$insertSql = sprintf("insert into stock (fiscalYear, sourceCodeId, entryNo, itemId, rate, qty, amount, sales_date_bs, sales_date_ad, status, sales_to, entry_date_bs, entry_date_ad, qty_out, unitId, discount_rate, discount_amount, net_amount,ref_no,g1,g2,g3,g4,g5,g6,g7,ref_date, sales_order_no) values ('%s','%d','%s','%d','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%d','%s','%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%s','%s')",
		$conn->real_escape_string($fiscalYear),
		$conn->real_escape_string($sourceCodeId),
		$conn->real_escape_string($entryNo),
		$conn->real_escape_string($itemId),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($sales_date_bs),
		$conn->real_escape_string($sales_date_ad),
		$conn->real_escape_string($status),
		$conn->real_escape_string($sales_to),
		$conn->real_escape_string($sales_date_bs),
		$conn->real_escape_string($sales_date_ad),
		$conn->real_escape_string($real_sales_qty),
		$conn->real_escape_string($unitId),
		$conn->real_escape_string($discount_rate),
		$conn->real_escape_string($discount_amount),
		$conn->real_escape_string($net_amount),
		$conn->real_escape_string($ref_no),
		$conn->real_escape_string($g1),
		$conn->real_escape_string($g2),
		$conn->real_escape_string($g3),
		$conn->real_escape_string($g4),
		$conn->real_escape_string($g5),
		$conn->real_escape_string($g6),
		$conn->real_escape_string($g7),
		$conn->real_escape_string($ref_date),
		$conn->real_escape_string($sales_order_no)
	);
	$conn->query($insertSql);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"salesAccount" => $salesAccount,
		"account"=>$account,
		"sales_to"=>$sales_to,
		"insertQry" => $insertSql
));
?>