<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  

	$id = $_REQUEST['id'];
	$group_name = $_REQUEST['group_name'];
	$group_code = $_REQUEST['group_code'];
	$parent_group_id = $_REQUEST['parent_group_id'];



	$parent_group_name="";
	$level = 0;
	if($parent_group_id>0){
		$sql="select * from inv_group where id='".$parent_group_id."'";
		$rs=$conn->query($sql);
		if(mysqli_num_rows($rs)){
			$r=mysqli_fetch_assoc($rs);
			$parent_group_name=$r['group_code'];
			$level = $r['level']+1;
		}
	}
	
	//consulta sql
	$query = sprintf("UPDATE inv_group SET group_code = '%s', group_name = '%s', parent_group_id = '%d',level ='%d' WHERE id=%d",
		$conn->real_escape_string($group_code),
		$conn->real_escape_string($group_name),
		$conn->real_escape_string($parent_group_id),
		$level,
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	
	if($parent_group_id>0){
		$query	="update inv_group	set hasChild = 1 where id ='".$parent_group_id."'";
		$conn->query($query);		
	}
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invgroups" => array(
			"id" => $id,
			"group_code" => $group_code,
			"group_name" => $group_name,
			"parent_group_id" => $parent_group_id,
			"parent_group"=>$parent_group_name
		)
	));
?>