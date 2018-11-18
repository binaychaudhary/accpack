<?php 
	include("../../includes/conectar.php");
	$node_id=$_REQUEST['node_id'];
	$sql="select * from inv_group where id='".$node_id."'";
	$rs =$conn->query($sql);
	$cnt=0;
	$data=array();
	if(mysqli_num_rows($rs)>0){
		
		while($r=mysqli_fetch_assoc($rs)){
			$data[]=$r;
		}	
	}
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"groupDetails" => $data
	));
?>