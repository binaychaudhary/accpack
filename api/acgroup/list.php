<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$group_name=$_REQUEST['group_name'];
	$parent_group = $_REQUEST['parent_group'];
	$ac_nature=$_REQUEST['ac_nature'];

	$cr="";
	
	if(is_null($group_name)||($group_name=="")){
	}else{
		if($cr==""){
			$cr=" where g.group_name like '%".$group_name . "%'";
		}else{
			$cr = $cr." and g.group_name like '%".$group_name . "%'";
		}
	}
	if(is_null($parent_group)||($parent_group=="")){
	}else{
		if($cr==""){
			$cr=" where g.parent_group_id =  '".$parent_group . "'";
		}else{
			$cr = $cr." and g.parent_group_id = '".$parent_group . "'";
		}
	}
	if(is_null($ac_nature)||($ac_nature=="")){
	}else{
		if($cr==""){
			$cr=" where g.ac_nature like  '".$ac_nature . "%'";
		}else{
			$cr = $cr." and g.ac_nature like '".$ac_nature . "%'";
		}
	}
	$queryString = "SELECT g.*, pg.group_name as parent_group, an.nature as ac_nature_desc from ac_group g left join ac_group as pg on g.parent_group_id = pg.id left join acnature an on g.ac_nature = an.id".$cr;
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
		"acgroups" => $data
	));
?>