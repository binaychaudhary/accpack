<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$info = $_POST['segmentdatas'];

	$data = json_decode($info);

	$name_np = $data->name_np;
	$name_en = $data->name_en;
	$segment_code = $data->segment_code;
	$segment_id = $data->segment_id;
	//$id = $data->id;
	//consulta sql
	$query = sprintf("INSERT INTO segmentdata(name_np, name_en, segment_code, segment_id) values ('%s', '%s','%s', '%d')",
		$conn->real_escape_string($name_np),
		$conn->real_escape_string($name_en),
		$conn->real_escape_string($segment_code),
		$conn->real_escape_string($segment_id));

	$rs = $conn->query($query);


	if($segment_id=="19"){
		$sql="select * from subgroup where groupId='19' and subGroupCode='".$segment_code."'";
		$rs = $conn->query($sql);
		if(mysqli_num_rows($rs)>0){
			$qry="update subgroup set subGroupName='$name_np', where groupId='$segment_id' and subgroupCode='$segment_code'";
		}else{
			$qry="insert into subgroup (groupId, subGroupCode, subGroupName, status) values('$segment_id','$segment_code','$name_np','1')";
		}
		$conn->query($qry);
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"segmentdatas" => array(
			"id" => mysqli_insert_id($conn->),
			"segment_id" => $segment_id,
			"segment_code" => $segment_code,
			"name_np" => $name_np,
			"name_en" => $name_en			
		)
	));
?>