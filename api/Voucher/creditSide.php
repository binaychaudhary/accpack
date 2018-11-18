<?php
	include("../../includes/conectar.php");

	$fiscalyear=$_REQUEST['fiscalyear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];
	//$userId=$_REQUEST['userId'];
	$cr="";
	if(is_null($fiscalyear)||($fiscalyear=="")){
	}else{
		if($cr==""){
			$cr=" where e.fiscalyear = '".$fiscalyear . "'";
		}else{
			$cr = $cr." and e.fiscalyear = '".$fiscalyear . "'";
		}
	}
	if(is_null($sourceCodeId)||($sourceCodeId=="")){
	}else{
		if($cr==""){
			$cr=" where e.sourceCodeId = '".$sourceCodeId . "'";
		}else{
			$cr = $cr." and e.sourceCodeId = '".$sourceCodeId. "'";
		}
	}
	if(is_null($entryNo)||($entryNo=="")){
	}else{
		if($cr==""){
			$cr=" where e.entryNo = '".$entryNo . "'";
		}else{
			$cr = $cr." and e.entryNo = '".$entryNo. "'";
		}
	}

	if($cr==""){
		$cr=" where e.credit>0";
	}else{
		$cr = $cr." and e.credit>0";
	}

	$queryString = "SELECT e.*, s.sourceCode, a.accountDesc, g.group_name as groupDesc from tmpentry e inner join sourcecode s on e.sourceCodeId=s.id inner join acmaster a on e.accountNo = a.accountNo  left join ac_group g on  e.ac_group = g.id ".$cr;
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$totalAmt =0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
	    $data[] = $dat;
	    $cnt=$cnt+1;
	    $totalAmt=$totalAmt + $dat['credit'];
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		//"qry"=>$queryString,
		"vouchers" => $data,
		"totalAmt" => $totalAmt
	));
?>