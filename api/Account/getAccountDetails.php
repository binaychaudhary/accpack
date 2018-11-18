<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$accountNo=$_REQUEST['accountNo'];
	$cr="";
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		$cr=" where acm.accountNo = '".$accountNo . "'";
	}
	
	$queryString = "SELECT acm.*, sg.group_name as subGroupName from acmaster acm left join ac_group sg on acm.ac_group = sg.id ".$cr;
	//echo $queryString;
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
		"accountnos" => $data
	));
?>