<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$hall_name=$_REQUEST['hall_name'];
	$size=$_REQUEST['size'];
	$capacity=$_REQUEST['capacity'];
	$status=$_REQUEST['status'];

	$cr="";
	
	if(is_null($hall_name)||($hall_name=="")){
	}else{
		if($cr==""){
			$cr=" where hall_name like '%".$hall_name . "%'";
		}else{
			$cr = $cr." and hall_name like '%".$hall_name . "%'";
		}
	}
	
	if(is_null($size)||($size=="")){
	}else{
		if($cr==""){
			$cr=" where size = '".$size . "'";
		}else{
			$cr = $cr." and = like '".$size . "'";
		}
	}

	if(is_null($capacity)||($capacity=="")){
	}else{
		if($cr==""){
			$cr=" where capacity = '".$capacity . "'";
		}else{
			$cr = $cr." and capacity = '".$capacity . "'";
		}
	}
	if(is_null($status)||($status=="")){
	}else{
		if($cr==""){
			$cr=" where status = '".$status . "'";
		}else{
			$cr = $cr." and status = '".$status . "'";
		}
	}
	$queryString = "SELECT * from hall  ".$cr;
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
		"halls" => $data
	));
?>