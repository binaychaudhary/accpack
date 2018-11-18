<?php
	include("../../includes/conectar.php");
	$accountNo=$_REQUEST['accountNo'];
	$start_date_ad=$_REQUEST['start_date_ad'];
	$end_date_ad=$_REQUEST['end_date_ad'];

	$query=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$rs= mysqli_fetch_assoc($query);
	$accountName= $rs['accountDesc'];
	$natureId=$rs['natureId'];
	$query="";
	$cr="";
	if(is_null($start_date_ad)||($start_date_ad=="")){
	}else{
		$cr=" where entry_date_ad >= '".$start_date_ad . "'";
	}
	if(is_null($end_date_ad)||($end_date_ad=="")){
	}else{
		if($cr==""){
			$cr=" where entry_date_ad <= '".$end_date_ad . "'";
		}else{
			$cr = $cr." and entry_date_ad <= '".$end_date_ad . "'";
		}
	}
	
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where accountNo = '".$accountNo . "'";
		}else{
			$cr = $cr." and accountNo = '".$accountNo . "'";
		}
	}
	// 
	$alya_cr = " where entry_date_ad < '".$start_date_ad . "' and accountNo = '".$accountNo . "'";
	if(($natureId ==2)||($natureId ==3)){
		$query="select sum(credit) - sum(debit) as alya from tmpentry".$alya_cr;
	}else{
		$query="select sum(debit) - sum(credit) as alya from tmpentry".$alya_cr;
	}
	//echo $query;
	$resp = $conn->query($query);
	$rs = mysqli_fetch_assoc($resp);
	$alya = $rs['alya'];

	$query="select sum(debit) as dbtSum, sum(credit) as crdSum from tmpentry ".$cr;
	$resp=$conn->query($query);
	
	if(mysqli_num_rows($resp)>0){
		$rs = mysqli_fetch_assoc($resp);
		$debit= $rs['dbtSum'];
		$credit = $rs['crdSum'];
	}

	if(($natureId ==2)||($natureId ==3)){
		$balance = $alya - $debit +$credit;
	}else{
		$balance = $alya + $debit -$credit;
	}
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"subGroupCode"=>$accountNo,
		"subGroupName"=>$accountName,
		"alya" => $alya,
		"debit"=>$debit,
		"credit" => $credit,
		"balance"=>$balance
	));
?>