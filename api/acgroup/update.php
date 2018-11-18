<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['acgroups'];

	// $data = json_decode($info);
	// $id = $data->id;
	// $group_name = $data->group_name;
	// $parent_group_id = $data->parent_group_id;
	// $parent_group= $data->parent_group;
	// //$level = $data->level;
	// $ac_nature = $data->ac_nature;
	// $ac_prefix = $data->ac_prefix;

	$id = $_REQUEST['id'];
	$group_name = $_REQUEST['group_name'];
	$parent_group_id = $_REQUEST['parent_group_id'];
	$parent_group= $_REQUEST['parent_group'];
	//$level = $_REQUEST['level'];
	$ac_nature = $_REQUEST['ac_nature'];
	$ac_prefix = $_REQUEST['ac_prefix'];
	
	$g7=0;
	$g6=0;
	$g5=0;
	$g4=0;
	$g3=0;
	$g2=0;
	$g1=0;
	$level = 0;

	$gSql="select * from ac_group where id='".$parent_group_id."'";
	$rs=$conn->query($gSql);
	$r= mysqli_fetch_assoc($rs);
	$g7=$r['g7'];
	$g6=$r['g6'];
	$g5=$r['g5'];
	$g4=$r['g4'];
	$g3=$r['g3'];
	$g2=$r['g2'];
	$g1=$r['g1'];
	$parent_group=$r['group_name'];
	
	$level = $r['level'];
	$lvl = $level+1;
	if(($parent_group_id=='') || (is_null($parent_group_id))){
		$parent_group_id=0;
	}
	if($_REQUEST['id'] ==""){
		
		$sql ="insert into ac_group(group_name, parent_group_id, level, g1, g2, g3, g4, g5, g6, g7, ac_nature, ac_prefix, status)";
		$sql =$sql . " values('".$group_name."','".$parent_group_id."','".$lvl."', '".$g1."', '".$g2."', '".$g3."', '".$g4."', '".$g5."', '".$g6."', '".$g7."','".$ac_nature."','".$ac_prefix."','1')";
		$rs = $conn->query($sql);
		$id = mysqli_insert_id($conn);
		$updSql = "update ac_group set g".$lvl." = '".$id."' where id ='".$id."'";
		$conn->query($updSql);

		//echo $sql;
	}else{
		$sql ="update ac_group set group_name = '".$group_name."', parent_group_id ='".$parent_group_id."', level='".$lvl."', ac_nature = '".$ac_nature."', ac_prefix='".$ac_prefix."', g1='".$g1."', g2='".$g2."', g3='".$g3."', g4='".$g4."', g5='".$g5."', g6='".$g6."', g7='".$g7."' where id='".$id."'";
		$conn->query($sql);

		$updSql = "update ac_group set g".$lvl." = '".$id."' where id ='".$id."'";
		$conn->query($updSql);
	}
	

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"acgroups" => array(
			"id" => $id,
			"group_name" => $group_name,
			"parent_group_id" =>$parent_group_id,
			"parent_group" =>$parent_group,
			"level" => $lvl,
			"ac_nature" =>$ac_nature,
			"ac_prefix" =>$ac_prefix,
			"status"=>1,
			"g1" =>$g1,
			"g2" =>$g2,
			"g3" =>$g3,
			"g4" =>$g4,
			"g5" =>$g5,
			"g6" =>$g6,
			"g7" =>$g7,
			"sql" => $sql
		)
	));
?>