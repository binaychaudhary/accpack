<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['structuredefs'];

	$data = json_decode($info);
	$structureId=$data->structureId;
	$segmentId = $data->segmentId;
	
	  // $structureId=$_REQUEST['structureId'];
	  // $segmentId = $_REQUEST['segmentId'];
	
	$rs=$conn->query("select * from segment where id='".$segmentId."'");
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$segmentDesc=$r['name_np'];
		$ln=$r['ln'];
	}

	//consulta sql
	$query = sprintf("INSERT INTO structuredef (structureId,segmentId,ln) values ('%d','%d','%d')",
		$conn->real_escape_string($structureId),
		$conn->real_escape_string($segmentId),
		$conn->real_escape_string($ln)
	);

	$rs = $conn->query($query);

	//generating segment list, length list
	$segList="";
	$lnList="";
	$query="select * from structuredef where structureId='".$structureId."' order by id";
	$rs=$conn->query($query);
	while($r=mysqli_fetch_assoc($rs)){
		if((is_null($segList))||($segList=="")) { 
			$segList=$r['segmentId'];
			$lnList=$r['ln'];
		}else{
			
			$segList=$segList."-".$r['segmentId'];
			$lnList=$lnList."-".$r['ln'];
		}		
	}
		

	$query="update structurecode set segments='".$segList."', segLength='".$lnList."' where id='".$structureId."'";
	$conn->query($query);
	//end of segment list and length list
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"structuredefs" => array(
			"id" => mysqli_insert_id($conn),
			"structureId" => $structureId,
			"segmentId"=>$segmentId,
			"segmentDesc"=>$segmentDesc,
			"ln" => $ln
		)
	));
?>