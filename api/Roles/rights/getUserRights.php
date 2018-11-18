<?php
	include("../../../includes/conectar.php");
	$roleId = $_REQUEST['roleId'];
	//reading rights
	$rights="";
	//all
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=0";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	//view
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=1";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	//add
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=2";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	//edit
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=3";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	//delete
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=4";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	//print
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=5";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	//usermgmt
	$sql ="select * from rightsassigned where roleId='".$roleId."' and status=1 and rightId=6";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$rights=$rights."1";
	}else{
		$rights=$rights."0";
	}
	echo json_encode(array(
		"rights" => $rights		
	));
?>