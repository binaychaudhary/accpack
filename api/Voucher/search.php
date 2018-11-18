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

		// if($entryNo=="नयाँ भाैचर"){
		// 	if($cr==""){
		// 		$cr=" where e.userId = '".$userId . "'";
		// 	}else{
		// 		$cr = $cr." and e.userId = '".$userId. "'";
		// 	}
		// }
	}
	
	$queryString = "SELECT e.*, s.sourceCode, a.accountDesc, sg.group_name as groupDesc from tmpentry e left join sourcecode s on e.sourceCodeId=s.id left join acmaster a on e.accountNo = a.accountNo left join ac_group sg on e.ac_group=sg.id ".$cr." order by id";
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		//"qry"=>$queryString,
		"vouchers" => $data
	));
?>