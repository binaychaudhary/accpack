<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['groupsavingintrates'];

	$data = json_decode($info);
	$id = $data->id;
	$subGroupId=$data->subGroupId;
	$matureTypeId=$data->matureTypeId;
	$effectedDateAd =  date("Y-m-d",strtotime($data->effectedDateAd));
	$effectedDateBs = $data->effectedDateBs;
	$rate = $data->rate;
	$tax_rate = $data->tax_rate;
	
	// $id = $_REQUEST['id'];
	// $subGroupId=$_REQUEST['subGroupId'];
	// $matureTypeId=$_REQUEST['matureTypeId'];
	// $effectedDateAd = $_REQUEST['effectedDateAd'];
	// $effectedDateBs = $_REQUEST['effectedDateBs'];
	// $rate = $_REQUEST['rate'];

	$ssql ="SELECT * FROM subgroup where id='".$subGroupId."'";
	$rs = $conn->query($ssql);
	//echo $ssql."<br>";
	$r = mysqli_fetch_assoc($rs);
	$subGroupDesc = $r['subGroupName'];
	$subGroupCode = $r['subGroupCode'];
	$rs = $conn->query("select * from matureperiod where id = '".$matureTypeId."'");
	$r = mysqli_fetch_assoc($rs);
	$periodDesc = $r['periodDesc'];	

	//consulta sql
	$query = sprintf("UPDATE groupintrate SET subGroupId = '%d', effectedDateAd = '%s', effectedDateBs='%s', rate='%s', tax_rate='%s' WHERE id=%d",
		$conn->real_escape_string($subGroupId),
		$conn->real_escape_string($effectedDateAd),
		$conn->real_escape_string($effectedDateBs),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($tax_rate),
		$conn->real_escape_string($id)
	);
	
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"groupsavingintrates" => array(
			"id" => $id,
			"subGroupId" => $subGroupId,
			"matureTypeId" =>$matureTypeId,
			"effectedDateBs"=>$effectedDateBs,
			"effectedDateAd"=>$effectedDateAd,
			"rate"=>$rate,
			"tax_rate"=>$tax_rate,
			"subGroupDesc"=>$subGroupDesc,
			"subGroupCode" => $subGroupCode,
			"matureType" =>$periodDesc
		)
	));
?>