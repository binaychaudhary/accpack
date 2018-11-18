<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$department=$_REQUEST['department'];
	$cr="";
	
	if(is_null($department)||($department=="")){
	}else{
		if($cr==""){
			$cr=" where dp.department like '%".$department . "%'";
		}else{
			$cr = $cr." and dp.department like '%".$department . "%'";
		}
	}
	
	$queryString = "SELECT dp.*, st.staffName from department dp left join staff st on dp.dept_head_id= st.id ".$cr;
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
		"departmentss" => $data
	));
?>