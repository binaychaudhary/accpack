<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$sourceCode=$_REQUEST['sourceCode'];
	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where s.status = '".$status . "'";
	}
	if(is_null($sourceCode)||($sourceCode=="")){
	}else{
		if($cr==""){
			$cr=" where s.sourceCode like '%".$sourceCode . "%'";
		}else{
			$cr = $cr." and s.sourceCode like '%".$sourceCode . "%'";
		}
	}
	
	$queryString = "SELECT s.*, c.category from sourcecode s left join sourcecodecategory c on s.categoryId= c.id ".$cr." LIMIT $start,  $limit";
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
		"sourcecodes" => $data
	));
?>