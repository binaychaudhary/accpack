<?php
	include("../../includes/conectar.php");
	
	$query="select * from groupsummary";
	$resp=$conn->query($query);
	$data = array();
	$cnt=0;
	if(mysqli_num_rows($resp)>0){
		while($r= mysqli_fetch_assoc($resp)){
			$data[]=$r;
			$cnt=$cnt+1;
		}
	}
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"groupsummary" => $data
	));
?>