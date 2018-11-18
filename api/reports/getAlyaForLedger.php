<?php
	
	include("../../includes/conectar.php");
	$accountNo=$_REQUEST['accountNo'];
	$fromDtAd = date($_REQUEST['fromDtAd']);
	$fYearStartDtAd=$_REQUEST['fYearStartDtAd'];
	$qry=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$rs = mysqli_fetch_assoc($qry);
	$natureId = $rs['natureId'];
	if(($natureId  ==2 ) || ($natureId ==3)){
		$q="select sum(credit)- sum(debit) as balance from tmpentry where  entry_date_ad<'".$fromDtAd."' and accountNo='".$accountNo."'";
	}else{
		$q="select sum(debit)- sum(credit) as balance from tmpentry where  entry_date_ad<'".$fromDtAd."' and accountNo='".$accountNo."'";
	}
	//echo $q;
	$qry = $conn->query($q);
	$rs= mysqli_fetch_assoc($qry);
	$balance = $rs['balance'];
	if(($natureId  ==2 ) || ($natureId ==3)){
		$DrCr="Cr";
		if($balance<0){$DrCr="Dr";}
	}else{
		$DrCr="Dr";
		if($balance<0){$DrCr="Dr";}
	}
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"natureId"=>$natureId,
		"balance"=>$balance,
		"DrCr"=>$DrCr
	));
?>