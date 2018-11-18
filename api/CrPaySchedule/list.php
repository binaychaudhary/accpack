<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	 $loan_amount = $_REQUEST['loan_amount'];
	$interest_type=$_REQUEST['interest_type'];
	$installment_period=$_REQUEST['installment_period'];
	
	$cr="";
	
	if(is_null($loan_amount)||($loan_amount=="")){
	}else{
		if($cr==""){
			$cr=" where ins.loan_amount = '".$loan_amount . "'";
		}else{
			$cr = $cr." and ins.loan_amount = '".$loan_amount . "'";
		}
	}

	if(is_null($interest_type)||($interest_type=="")){
	}else{
		if($cr==""){
			$cr=" where ins.interest_type = '".$interest_type . "'";
		}else{
			$cr = $cr." and ins.interest_type = '".$interest_type . "'";
		}
	}

	if(is_null($installment_period)||($installment_period=="")){
	}else{
		if($cr==""){
			$cr=" where ins.installment_period = '".$installment_period . "'";
		}else{
			$cr = $cr." and ins.installment_period = '".$installment_period . "'";
		}
	}
	$queryString = "SELECT ins.*, ids.interest_rate  from installment_schedule ins";
	$queryString.= " left join installment_details ids on ids.schedule_id = ins.id".$cr;
	$query=$conn->query($queryString)	or die(mysqli_connect_error());

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
		"crpayschedules" => $data
	));
?>