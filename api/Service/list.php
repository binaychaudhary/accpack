<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$sdescription=$_REQUEST['sdescription'];
	$cr="";
	
	if(is_null($sdescription)||($sdescription=="")){
	}else{
		if($cr==""){
			$cr=" where sdescription like '%".$sdescription . "%'";
		}else{
			$cr = $cr." and sdescription like '%".$sdescription . "%'";
		}
	}
	
	$queryString = "SELECT * from service  ".$cr;
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
		"services" => $data
	));
?>