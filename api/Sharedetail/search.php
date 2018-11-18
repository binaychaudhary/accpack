<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$accountNo=$_REQUEST['accountNo'];
	$accountDesc=$_REQUEST['accountDesc'];
	$father_name=$_REQUEST['father_name'];
	$grand_father=$_REQUEST['grand_father'];
	$cr="";
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		$cr=" where s.accountNo like '%".$accountNo . "%'";
	}
	if(is_null($father_name)||($father_name=="")){
	}else{
		if($cr==""){
			$cr=" where s.father_name like '".$father_name . "%'";
		}else{
			$cr = $cr." and s.father_name like '".$father_name . "%'";
		}
	}
	if(is_null($grand_father)||($grand_father=="")){
	}else{
		if($cr==""){
			$cr=" where s.grand_father like '".$grand_father . "%'";
		}else{
			$cr = $cr." and s.grand_father like '".$grand_father . "%'";
		}
	}
	if(is_null($accountDesc)||($accountDesc=="")){
	}else{
		if($cr==""){
			$cr=" where a.accountDesc like '".$accountDesc ."%'";
		}else{
			$cr = $cr." and a.accountDesc like '".$accountDesc . "%'";
		}
	}
	$queryString = "SELECT s.*, a.accountDesc from sharedetail s left join acmaster a on s.accountNo=a.accountNo ".$cr." LIMIT $start,  $limit";
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
		"sharedetails" => $data
	));
?>