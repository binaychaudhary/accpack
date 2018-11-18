<?php
	include_once("../conn.php");

	$designation = $_REQUEST['designation'];
	$status = $_REQUEST['status'];

	$cr ="";
	if(is_null($designation) || ($designation=="")){

	}else{
		if($cr==""){
			$cr=" where designation like '%".$designation."%'";	
		}else{
			$cr = $cr." and designation like '%".$designation."%'";
		}
	}

	if(is_null($status) || ($status=="")){

	}else{
		if($cr==""){
			$cr=" where status like '%".$status."%'";	
		}else{
			$cr = $cr." and staus like '%".$status."%'";
		}
		
	}

	$sql="select * from design ".$cr." order by id";
	$rs = $conn->query($sql);

	$data=array();
	while($r=mysqli_fetch_assoc($rs)){
		$data[]=$r;
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"designation" => $data
	));

?>