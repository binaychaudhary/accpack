<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['acgroups'];

	$data = json_decode($info);
	
	$group_name = $data->group_name;
	$parent_group_id = $data->parent_group_id;
	$parent_group=$r['parent_group'];
	
	$ac_nature = $data->ac_nature;
	$ac_prefix = $data->ac_prefix;


	$g7=0;
	$g6=0;
	$g5=0;
	$g4=0;
	$g3=0;
	$g2=0;
	$g1=0;
	$level = 0;
	if($parent_group_id !='' ){
		$gSql="select * from ac_group where id='$parent_group_id'";
		$rs=$conn->query($gSql);
		$r= mysqli_fetch_assoc($rs);
		$g7=$r['g7'];
		$g6=$r['g6'];
		$g5=$r['g5'];
		$g4=$r['g4'];
		$g3=$r['g3'];
		$g2=$r['g2'];
		$g1=$r['g1'];
		$level = $r['level'];
	}else{
		$level = 0;
	}

	if(($parent_group_id=='') || (is_null($parent_group_id)){
		$parent_group_id=0;
	}
	
	$sql ="select * from acnature where id='".$ac_nature."'";
	$rs = $conn->query($sql);
	$r= mysqli_fetch_assoc($rs);
	$ac_nature_desc = $r['nature'];

	if($data->id ==""){
		$lvl = $level+1;
		$sql ="insert into ac_group(group_name, parent_group_id, level, g1, g2, g3, g4, g5, g6, g7, ac_nature,ac_prefix, status)";
		$sql =$sql . " values('$group_name',$parent_group_id,$lvl, $g1, $g2, $g3, $g4, $g5, $g6, $g7,$ac_nature,'".$ac_prefix."',1)";
		$rs = $conn->query($sql);
		$id = mysqli_insert_id($conn);
		$conn->query($updSql);
	//	echo $sql;
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
			"$ac_nature_desc" => $ac_nature_desc,
			"$ac_prefix" => $ac_prefix,
			"status"=>1,
			"g1" =>$g1,
			"g2" =>$g2,
			"g3" =>$g3,
			"g4" =>$g4,
			"g5" =>$g5,
			"g6" =>$g6,
			"g7" =>$g7
		)
	));
?>