<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$rdescription=$_REQUEST['rdescription'];
	$cr="";
	
	if(is_null($rdescription)||($rdescription=="")){
	}else{
		if($cr==""){
			$cr=" where rdescription like '%".$rdescription . "%'";
		}else{
			$cr = $cr." and rdescription like '%".$rdescription . "%'";
		}
	}
	
	$queryString = "SELECT * from room_type  ".$cr;
	$query =$conn->query($queryString) or die(mysqli_connect_error());

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
		"roomtypes" => $data
	));
?>