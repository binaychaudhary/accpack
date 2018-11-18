<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$structureId=$_REQUEST['structureId'];
	$accountNo=$_REQUEST['accountNo'];
	$accountDesc=$_REQUEST['accountDesc'];
	$address=$_REQUEST['address'];
	$status=$_REQUEST['status'];
	$ac_group = $_REQUEST['ac_group'];
	$additional = $_REQUEST['additional'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where a.status = '".$status . "'";
	}
	if(is_null($structureId)||($structureId=="")){
	}else{
		if($cr==""){
			$cr=" where a.structureId = '".$structureId . "'";
		}else{
			$cr = $cr." and a.structureId = '".$structureId . "'";
		}
	}
	if(is_null($ac_group)||($ac_group=="")){
	}else{
		if($cr==""){
			$cr=" where acgr.id = '".$ac_group . "'";
		}else{
			$cr = $cr." and acgr.id = '".$ac_group . "'";
		}
	}
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where a.accountNo like '%".$accountNo . "%'";
		}else{
			$cr = $cr." and a.accountNo like '%".$accountNo . "%'";
		}
	}
	if(is_null($accountDesc)||($accountDesc=="")){
	}else{
		if($cr==""){
			$cr=" where a.accountDesc like '".$accountDesc . "%'";
		}else{
			$cr = $cr." and a.accountDesc like '".$accountDesc . "%'";
		}
	}
	if(is_null($address)||($address=="")){
	}else{
		if($cr==""){
			$cr=" where a.address  like'".$address . "%'";
		}else{
			$cr = $cr." and a.address like '".$address . "%'";
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
	$queryString = "SELECT a.*, s.subGroupName as subgroup, n.nature,sc.StructureCode, acgr.group_name as ac_group_desc from acmaster a left join subgroup s on a.subgroupId= s.id left join acnature n on a.natureId = n.id left join structurecode sc on a.structureId = sc.id left join ac_group acgr on acgr.id = a.ac_group ".$cr." order by id LIMIT $start,  $limit";
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
		"accountnos" => $data,
		"queryString"=>$queryString
	));
?>