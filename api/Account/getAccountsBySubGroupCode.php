<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$subgroupCode=$_REQUEST['subGroupCode'];
	$additional = $_REQUEST['additional'];
	$cr="";
	if(is_null($subgroupCode)||($subgroupCode=="")){
	}else{
		if($cr==""){
			$cr=" where a.subGroupId ='".$subgroupCode . "'";
		}else{
			$cr = $cr." and a.subGroupId = '".$subgroupCode . "'";
		}
	}
	if(is_null($additional)||($additional=="")){
	}else{
		if($cr==""){
			$cr=" where ".$additional;
		}else{
			$cr = $cr." and ".$additional;
		}
	}
	$queryString = "SELECT a.* from acmaster a ".$cr." order by a.accountNo";
	//echo $queryString;
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
		"accounts" => $data
	));
?>