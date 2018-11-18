<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//mysql_query("SET NAMES utf8");  
	$info = $_POST['structuredefs'];

	$data = json_decode($info);
	$id = $data->id;
	$structureId=$data->structureId;
	$segmentId = $data->segmentId;
	
	$rs=$conn->query("select * from segment where id='".$segmentId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$segmentDesc=$r['name_np'];
		$ln=$r['ln'];
	}
	
	//consulta sql
	$query = sprintf("UPDATE structuredef SET  segmentId='%d', ln = '%d' WHERE id=%d",
		$conn->real_escape_string($segmentId),
		$conn->real_escape_string($ln),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	$segList="";
	$lnList="";
	$query="select * from structuredef where structureId='".$structureId."' order by id";
	$rs=$conn->query($query);
	while($r=mysqli_fetch_assoc($rs)){
		if(len($segList)>0){
			$segList=$segList."-".$r['segmentId'];
			$lnList=$lnList."-".$r['ln'];
		}else{
			$segList=$r['segmentId'];
			$lnList=$r['ln'];
		}		
	}
		

	$query="update structurecode set segments='".$segList."', segLength='".$lnList."' where id='".$structureId."'";
	$conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"structuredefs" => array(
			"id" => $id,
			"structureId" => $structureId,
			"segmentId"=>$segmentId,
			"segmentDesc"=>$segmentDesc,
			"ln" => $ln
		)
	));
?>