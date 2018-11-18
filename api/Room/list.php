<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$room_type_id=$_REQUEST['room_type_id'];
	$room_no=$_REQUEST['room_no'];
	$bed_type_id=$_REQUEST['bed_type_id'];
	$status=$_REQUEST['status'];
	$cr="";
	
	if(is_null($room_type_id)||($room_type_id=="")){
	}else{
		if($cr==""){
			$cr=" where r.room_type_id = '".$room_type_id . "'";
		}else{
			$cr = $cr." and r.room_type_id = '".$room_type_id . "'";
		}
	}

	if(is_null($room_no)||($room_no=="")){
	}else{
		if($cr==""){
			$cr=" where r.room_no like'%".$room_no . "%'";
		}else{
			$cr = $cr." and r.room_no like '%".$room_no . "%'";
		}
	}

	if(is_null($bed_type_id)||($bed_type_id=="")){
	}else{
		if($cr==""){
			$cr=" where r.bed_type_id = '".$bed_type_id . "'";
		}else{
			$cr = $cr." and r.bed_type_id = '".$bed_type_id . "'";
		}
	}
	
	if(is_null($status)||($status=="")){
	}else{
		if($cr==""){
			$cr=" where r.status = '".$status . "'";
		}else{
			$cr = $cr." and r.status = '".$status . "'";
		}
	}

	$queryString = "SELECT r.*, rt.rdescription ,b.bdescription  from room r";
	$queryString.= " left join room_type rt on r.room_type_id = rt.id";
	$queryString.= " left join bed_type b on r.bed_type_id = b.id".$cr;
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
		"rooms" => $data,
		"q"=>$queryString
	));
?>