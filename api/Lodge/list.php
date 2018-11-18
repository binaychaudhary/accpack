<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$edate_bs=$_REQUEST['edate_bs'];
	$name=$_REQUEST['name'];
	$cr="";
	
	if(is_null($edate_bs)||($edate_bs=="")){
	}else{
		if($cr==""){
			$cr=" where edate_bs = '".$edate_bs . "'";
		}else{
			$cr = $cr." and edate_bs = '".$edate_bs . "'";
		}
	}
	
	if(is_null($name)||($name=="")){
	}else{
		if($cr==""){
			$cr=" where name = '".$name . "'";
		}else{
			$cr = $cr." and name = '".$name . "'";
		}
	}
	$queryString = "SELECT * from lodge  ".$cr;
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
		"lodges" => $data
	));
?>