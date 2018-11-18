<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$userName=$_REQUEST['userName'];
	$roleId=$_REQUEST['roleId'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where u.status = '".$status . "'";
	}
	if(is_null($userName)||($userName=="")){
	}else{
		if($cr==""){
			$cr=" where u.userName like '".$userName . "%'";
		}else{
			$cr = $cr." and u.userName like '".$userName . "%'";
		}
	}
	if(is_null($roleId)||($roleId=="")){
	}else{
		if($cr==""){
			$cr=" where u.roleId = '".$roleId . "'";
		}else{
			$cr = $cr." and u.roleId = '".$roleId . "'";
		}
	}
	
	$queryString = "SELECT u.*, r.role FROM user u left join role r on u.roleId=r.id ".$cr." LIMIT $start,  $limit";
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
		"users" => $data
	));
?>