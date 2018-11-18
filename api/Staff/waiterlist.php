<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	
	$status=$_REQUEST['status'];
	$designationId=$_REQUEST['designationId'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		if($cr==""){
			$cr=" where s.status = '".$status . "'";
		}else{
			$cr = $cr." and s.status = '".$status . "'";
		}
	}
	
	if(is_null($designationId)||($designationId=="")){
	}else{
		if($cr==""){
			$cr=" where s.designationId = '".$designationId . "'";
		}else{
			$cr = $cr." and s.designationId = '".$designationId . "'";
		}
	}
	// if($cr==""){
	// 	$cr=" where s.id > 1";
	// }else{
	// 	$cr = $cr." and s.id > 1";
	// }
	$queryString = "SELECT s.*, d.designation from staff s left join designation d on s.designationId= d.id ".$cr;
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
		"staffs" => $data
	));
?>