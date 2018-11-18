<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$natureId=$_REQUEST['natureId'];
	$groupCode=$_REQUEST['groupCode'];
	$groupName=$_REQUEST['groupName'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where g.status = '".$status . "'";
	}
	if(is_null($groupCode)||($groupCode=="")){
	}else{
		if($cr==""){
			$cr=" where g.groupCode like '%".$groupCode . "%'";
		}else{
			$cr = $cr." and g.groupName like '%".$groupCode . "%'";
		}
	}
	if(is_null($groupName)||($groupName=="")){
	}else{
		if($cr==""){
			$cr=" where g.groupName like '%".$groupName . "%'";
		}else{
			$cr = $cr." and g.groupName like '%".$groupName . "%'";
		}
	}
	if(is_null($natureId)||($natureId=="")){
	}else{
		if($cr==""){
			$cr=" where g.natureId = '".$natureId . "'";
		}else{
			$cr = $cr." and g.natureId = '".$natureId . "'";
		}
	}
	$queryString = "SELECT g.*, n.nature from groups g left join acnature n on g.natureId=n.id ".$cr." LIMIT $start,  $limit";
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
		"qry" => $queryString,
		"groups" => $data
	));
?>