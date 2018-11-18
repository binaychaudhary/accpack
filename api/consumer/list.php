<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$consumer_name=$_REQUEST['consumer_name'];
	$accountNo=$_REQUEST['accountNo'];
	$house_no=$_REQUEST['house_no'];
	$meter_no=$_REQUEST['meter_no'];
	$status=$_REQUEST['status'];
	$cr="";
	
	if(is_null($consumer_name)||($consumer_name=="")){
	}else{
		if($cr==""){
			$cr=" where c.consumer_name like '%".$consumer_name . "%'";
		}else{
			$cr = $cr." and c.consumer_name like '%".$consumer_name . "%'";
		}
	}
	if(is_null($house_no)||($house_no=="")){
	}else{
		if($cr==""){
			$cr=" where c.house_no like '%".$house_no . "%'";
		}else{
			$cr = $cr." and c.house_no like '%".$house_no . "%'";
		}
	}
	if(is_null($meter_no)||($meter_no=="")){
	}else{
		if($cr==""){
			$cr=" where c.meter_no like '%".$meter_no . "%'";
		}else{
			$cr = $cr." and c.meter_no like '%".$meter_no . "%'";
		}
	}
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where c.accountNo like '%".$accountNo . "%'";
		}else{
			$cr = $cr." and c.accountNo like '%".$accountNo . "%'";
		}
	}
	
	$queryString = "SELECT c.*,concat(c.cur_vdc_mpc,'-',c.cur_ward_no) as address, lm.local_migrated, ct.consumer_type from consumer c left join local_migration lm on c.local_migrated_id = lm.id left join consumer_type ct on c.consumer_type_id = ct.id ".$cr." order by c.id";
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
		"consumers" => $data
	));
?>