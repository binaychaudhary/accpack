<?php
	include("../../includes/conectar.php");
	$subGroupCode=$_REQUEST['subGroupCode'];
	$natureId = $_REQUEST['natureId'];
	$start_date_ad=$_REQUEST['start_date_ad'];
	$end_date_ad=$_REQUEST['end_date_ad'];

	$query=$conn->query("select group_name, level, parent_group_id from ac_group where id='".$subGroupCode."'");
	$rs= mysqli_fetch_assoc($query);
	$subGroupName= $rs['group_name'];
	$level = $rs['level'];
	$parent_group_id = $rs['parent_group_id'];

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
	$par_lvl = $level -1;
	if($level>1){
		$par_lvl = $level -1;
		if($cr==""){
			$cr=" where g".$par_lvl." ='$parent_group_id' and g".$level." = '$level'";
		}else{
			$cr = $cr." and  g".$par_lvl." ='$parent_group_id' and g".$level." = '$subGroupCode'";
		}
	}
	// 
	$alya_cr = " where entry_date_ad < '".$start_date_ad . "' and g".$par_lvl." ='$parent_group_id' and g".$level." = '$subGroupCode'";
	if(($natureId ==2)||($natureId ==3)){
		$query="select sum(credit) - sum(debit) as alya from tmpentry".$alya_cr;
	}else if(($natureId ==1)||($natureId ==4)){
		$query="select sum(debit) - sum(credit) as alya from tmpentry".$alya_cr;
	}
	
	$resp = $conn->query($query);
	$rs = mysqli_fetch_assoc($resp);
	$alya = $rs['alya'];

	$query="select sum(debit) as dbtSum, sum(credit) as crdSum from tmpentry ".$cr;
	$resp=$conn->query($query);
	//echo $query;
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
		"subGroupCode"=>$subGroupCode,
		"subGroupName"=>$subGroupName,
		"alya" => $alya,
		"debit"=>$debit,
		"credit" => $credit,
		"balance"=>$balance
	));
?>