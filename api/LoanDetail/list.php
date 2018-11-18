<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$accountNo=$_REQUEST['accountNo'];
	$accountDesc=$_REQUEST['accountDesc'];
	$father_name=$_REQUEST['father_name'];
	$interest_type_id=$_REQUEST['interest_type_id'];
	$payment_type_id=$_REQUEST['payment_type_id'];
	// $entryNo=$_REQUEST['entryNo'];
	// $approvalStatus=$_REQUEST['approvalStatus'];
	
	 $cr="";

	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr = $cr." where am.accountNo like '%".$accountNo."%'";
		}else{
			$cr = $cr." and am.accountNo like '%".$accountNo."%'";
		}		
	}
	if(is_null($accountDesc)||($accountDesc=="")){
	}else{
		if($cr==""){
			$cr = $cr." where am.accountDesc like '%".$accountDesc."%'";
		}else{
			$cr = $cr." and am.accountDesc like '%".$accountDesc."%'";
		}		
	}
	if(is_null($father_name)||($father_name=="")){
	}else{
		if($cr==""){
			$cr = $cr." where ld.father_name like '%".$father_name."%'";
		}else{
			$cr = $cr." and ld.father_name like '%".$father_name."%'";
		}		
	}
	if(is_null($payment_type_id)||($payment_type_id=="")){
	}else{
		if($cr==""){
			$cr = $cr." where ld.payment_type_id = '".$payment_type_id."'";
		}else{
			$cr = $cr." and ld.payment_type_id = '".$payment_type_id."'";
		}		
	}
	if(is_null($interest_type_id)||($interest_type_id=="")){
	}else{
		if($cr==""){
			$cr = $cr." where ld.interest_type_id = '".$interest_type_id."'";
		}else{
			$cr = $cr." and ld.interest_type_id = '".$interest_type_id."'";
		}		
	}

	// if(is_null($entryNo)||($entryNo=="")){
	// }else{
	// 	$cr = $cr." and e.entryNo like '%".$entryNo."%'";
	// }

	// if(is_null($approvalStatus)||($approvalStatus=="")){
	// }else{
	// 	$cr = $cr." and e.approvalStatus = '".$approvalStatus."'";
	// }
	$queryString = "SELECT ld.*, am.accountNo as loan_ac_no, am.accountDesc as loan_ac_desc, it.interest_type, pt.payment_type  from loan_detail ld left join acmaster am on ld.loan_ac_id = am.id left join interest_type it on ld.interest_type_id = it.id left join loan_payment_type pt on ld.interest_type_id = pt.id ".$cr;
	//consulta sql
	//echo $queryString;
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"loandetails" => $data,
		"query" =>$queryString
	));
?>