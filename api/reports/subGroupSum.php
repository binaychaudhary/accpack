<?php
	include("../../includes/conectar.php");
	$groupCode=$_REQUEST['groupCode'];
	$subGroupCode=$_REQUEST['subGroupCode'];
	$start_date_ad=$_REQUEST['start_date_ad'];
	$end_date_ad=$_REQUEST['end_date_ad'];

	$cr="";
	// if(is_null($start_date_ad)||($start_date_ad=="")){
	// }else{
	// 	$cr=" where s.entry_date_ad >= '".$start_date_ad . "'";
	// }
	if(is_null($end_date_ad)||($end_date_ad=="")){
	}else{
		if($cr==""){
			$cr=" where s.entry_date_ad <= '".$end_date_ad . "'";
		}else{
			$cr = $cr." and s.entry_date_ad <= '".$end_date_ad . "'";
		}
	}
	if(is_null($groupCode)||($groupCode=="")){
	}else{
		if($cr==""){
			$cr=" where s.groupCode = '".$groupCode . "'";
		}else{
			$cr = $cr." and s.groupCode = '".$groupCode . "'";
		}
	}
	if(is_null($subGroupCode)||($subGroupCode=="")){
	}else{
		if($cr==""){
			$cr=" where s.subGroupCode = '".$subGroupCode . "'";
		}else{
			$cr = $cr." and s.subGroupCode = '".$subGroupCode . "'";
		}
	}
	$query="select sum(debit) as dbtSum, sum(credit) as crdSum from tmpentry s".$cr;
	$resp=$conn->query($query);
	$data = array();
	$cnt=0;
	if(mysqli_num_rows($resp)>0){
		while($r= mysqli_fetch_assoc($resp)){
			$data[]=$r;
			$cnt=$cnt+1;
		}
	}
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"query"=>$query,
		"subGroupSum" => $data
	));
?>