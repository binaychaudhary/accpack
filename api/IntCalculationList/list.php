<?php
	include("../../includes/conectar.php");
	$acadyear = $_REQUEST['acadyear'];
	$from_date_ad = $_REQUEST['from_date_ad'];
	$upto_date_ad = $_REQUEST['upto_date_ad'];
	$amount = $_REQUEST['amount'];

	$cr="";
	if(is_null($acadyear)||($acadyear=="")){
	}else{
		if($cr==""){
			$cr=" where i.acadyear = '".$acadyear . "'";
		}else{
			$cr = $cr." and i.acadyear = '".$acadyear . "'";
		}
	}

	if(is_null($from_date_ad)||($from_date_ad=="")){
	}else{
		if($cr==""){
			$cr=" where i.entry_date_ad >= '".$from_date_ad . "'";
		}else{
			$cr = $cr." and i.entry_date_ad >= '".$from_date_ad . "'";
		}
	}

	if(is_null($upto_date_ad)||($upto_date_ad=="")){
	}else{
		if($cr==""){
			$cr=" where i.entry_date_ad <= '".$upto_date_ad . "'";
		}else{
			$cr = $cr." and i.entry_date_ad <= '".$upto_date_ad . "'";
		}
	}	

	$sql ="select i.*  from intCalculationList i".$cr;
	$rs = $conn->query($cr);

	$data = array();
	$cnt=0;
	while($dat = mysqli_fetch_assoc($rs)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"intcalculationlist" => $data
	));
?>