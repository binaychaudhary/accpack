<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$group_code = $_REQUEST['group_code'];
	$group_name=$_REQUEST['group_name'];
	$parent_group_id=$_REQUEST['parent_group_id'];
	$cr="";
	
	if(is_null($group_code)){
	}else{
		if($cr==""){
			$cr=" where u.group_code like '%".$group_code . "%'";
		}else{
			$cr = $cr." and u.group_code like '%".$group_code . "%'";
		}
	}
	if(is_null($group_name)||($group_name=="")){
	}else{
		if($cr==""){
			$cr=" where u.group_name like '%".$group_name . "%'";
		}else{
			$cr = $cr." and u.group_name like '%".$group_name . "%'";
		}
	}
	if(is_null($parent_group_id)||($parent_group_id=="")){
	}else{
		if($cr==""){
			$cr=" where u.parent_group_id = '".$parent_group_id . "'";
		}else{
			$cr = $cr." and u.parent_group_id = '".$parent_group_id . "'";
		}
	}
	
	$queryString = "SELECT u.*, p.group_code as parent_group FROM inv_group u left join inv_group p on u.parent_group_id=p.id  ".$cr." order by id";
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
		if($dat['hasChild']){
			$sql="select count(*) as cnt from inv_group where parent_group_id='".$dat['id']."'";	
			$rsN=$conn->query($sql);
			$r= mysqli_fetch_assoc($rsN);	
			$cont = $r['cnt'];
		}else{
			$cont=0;
		}
		//echo($sql);


		$dat['count']=$cont;
	    $data[] = $dat;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"invgroups" => $data
	));
?>