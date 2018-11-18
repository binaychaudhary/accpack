<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');

	//$entry_date_bs=$_REQUEST['entry_date_bs'];
	$guest_name=$_REQUEST['name'];
	$address=$_REQUEST['address'];
	$email=$_REQUEST['email'];
	$gender=$_REQUEST['gender'];
	$country=$_REQUEST['country'];
	//$room_id=$_REQUEST['room_id'];
	//$booking_id=$_REQUEST['booking_id'];
	
	$cr="";

	// if(is_null($entry_date_bs)||($entry_date_bs=="")){
	// }else{
	// 	if($cr==""){
	// 		$cr=" where entry_date_bs like '%".$entry_date_bs . "%'";
	// 	}else{
	// 		$cr = $cr." and entry_date_bs like '%".$entry_date_bs . "%'";
	// 	}
	// }
	if(is_null($guest_name)||($guest_name=="")){
	}else{
		if($cr==""){
			$cr=" where guest_name like '%".$guest_name . "%'";
		}else{
			$cr = $cr." and guest_name like '%".$guest_name . "%'";
		}
	}
	// if(is_null($booked_for_bs)||($booked_for_bs=="")){
	// }else{
	// 	if($cr==""){
	// 		$cr=" where booked_for_bs like '%".$booked_for_bs . "%'";
	// 	}else{
	// 		$cr = $cr." and booked_for_bs like '%".$booked_for_bs . "%'";
	// 	}
	// }
	if(is_null($gender)||($gender=="")){
	}else{
		if($cr==""){
			$cr=" where gender like '%".$gender . "%'";
		}else{
			$cr = $cr." and gender like '%".$gender . "%'";
		}
	}
	
	// if(is_null($room_id)||($room_id=="")){
	// }else{
	// 	if($cr==""){
	// 		$cr=" where room_id like '%".$room_id . "%'";
	// 	}else{
	// 		$cr = $cr." and room_id like '%".$room_id . "%'";
	// 	}
	// }


	


	
	$queryString = "SELECT * from arrival_type  ".$cr;
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
		"arrivals" => $data
	));
?>