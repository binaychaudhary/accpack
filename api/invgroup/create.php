<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	$info = $_POST['invgroups'];

	$data = json_decode($info);

	$group_code = $data->group_code;
	$group_name = $data->group_name;
	$parent_group_id = $data->parent_group_id;

	 // $group_code = $_REQUEST['group_code'];
	 // $group_name = $_REQUEST['group_name'];
	 // $parent_group_id = $_REQUEST['parent_group_id'];

	 $parent_group_name="";
	 $level =0;
	if($parent_group_id>0){
		$sql="select * from inv_group where id='".$parent_group_id."'";
		$rs=$conn->query($sql);
		if(mysqli_num_rows($rs)){
			$r=mysqli_fetch_assoc($rs);
			$parent_group_name=$r['group_code'];
			$level = $r['level']+1;
		}else{
			$parent_group_name="";
		}
	}
	//consulta sql
	$query = sprintf("INSERT INTO inv_group (group_code, group_name, parent_group_id, level) values ('%s','%s','%d','%d')",
		$conn->real_escape_string($group_code),
		$conn->real_escape_string($group_name),
		$conn->real_escape_string($parent_group_id),
		$level
		);

	$rs = $conn->query($query);
	$newId = mysqli_insert_id($conn);
	if($parent_group_id>0){
		$query	="update inv_group set hasChild = 1 where id ='".$parent_group_id."'";
		$conn->query($query);	
	}
	//updateing group id
	$cr=" set parent_group_id ='$parent_group_id'";
	if($level>0){
		while($level>0){
			
			$cr= $cr .",g".$level."='".$parent_group_id."'";
			$gSql ="select parent_group_id from inv_group where id='$parent_group_id'";
			$rs= $conn->query($gSql);
			$r=mysqli_fetch_assoc($rs);
			$parent_group_id=$r['parent_group_id'];
			$level = $level	-1;
		}
		$cr = $cr." where id =".$newId;
		$sql="update inv_group".$cr;
		$conn->query($sql);
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invgroups" => array(
			"id" => $newId,
			"group_code" => $group_code,
			"group_name" => $group_name,
			"parent_group_id" => $parent_group_id,
			"parent_group"=>$parent_group_name,
			"count"=>0
		)
	));
?>