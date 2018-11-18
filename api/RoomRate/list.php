<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$room_id=$_REQUEST['room_id'];
	$effective_date_bs=$_REQUEST['effective_date_bs'];
	$cr="";
	
	if(is_null($room_id)||($room_id=="")){
	}else{
		if($cr==""){
			$cr=" where rr.room_id = '".$room_id . "'";
		}else{
			$cr = $cr." and rr.room_id = '".$room_id . "'";
		}
	}
	
	if(is_null($effective_date_bs)||($effective_date_bs=="")){
	}else{
		if($cr==""){
			$cr=" where rr.effective_date_bs = '".$effective_date_bs . "'";
		}else{
			$cr = $cr." and rr.effective_date_bs = '".$effective_date_bs . "'";
		}
	}
	$queryString = "SELECT rr.*, rt.rdescription   from room_rate rr";
	$queryString.= " left join room_type rt on rr.room_id = rt.id".$cr;
	
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
		"roomrates" => $data
	));
?>