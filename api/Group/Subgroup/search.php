<?php
	//chama o arquivo de conexão com o bd
	include("../../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$groupId=$_REQUEST['groupId'];
	$subGroupCode=$_REQUEST['subGroupCode'];
	$subGroupName=$_REQUEST['subGroupName'];

	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where s.status = '".$status . "'";
	}
	if(is_null($subGroupCode)||($subGroupCode=="")){
	}else{
		if($cr==""){
			$cr=" where s.subGroupCode like '".$subGroupCode . "%'";
		}else{
			$cr = $cr." and s.subGroupCode like '".$subGroupCode . "%'";
		}
	}
	if(is_null($subGroupName)||($subGroupName=="")){
	}else{
		if($cr==""){
			$cr=" where s.subGroupName like '".$subGroupName . "%'";
		}else{
			$cr = $cr." and s.subGroupName like '".$subGroupName . "%'";
		}
	}
	if(is_null($groupId)||($groupId=="")){
	}else{
		if($cr==""){
			$cr=" where s.groupId in(".$groupId . ")";
		}else{
			$cr = $cr." and s.groupId in(".$groupId . ")";
		}
	}
	$queryString = "SELECT s.*, g.groupName from subgroup s left join groups g on s.groupId=g.id ".$cr." LIMIT $start,  $limit";
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
		"subgroups" => $data
	));
?>