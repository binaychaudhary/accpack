<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	// $bdescription=$_REQUEST['bdescription'];
	// $cr="";
	
	// if(is_null($bdescription)||($bdescription=="")){
	// }else{
	// 	if($cr==""){
	// 		$cr=" where bdescription like '%".$bdescription . "%'";
	// 	}else{
	// 		$cr = $cr." and bdescription like '%".$bdescription . "%'";
	// 	}
	// }
	
	$queryString = "SELECT * from item_group  ";
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
		"itemgroups" => $data
	));
?>