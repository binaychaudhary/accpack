<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['groupsavingintrates'];

	$data = json_decode($info);
	$subGroupId=$data->subGroupId;
	$matureTypeId=$data->matureTypeId;
	$effectiveDateAd = date("Y-m-d",strtotime($data->effectedDateAd));
	$effectiveDateBs = $data->effectedDateBs;
	$rate = $data->rate;
	$tax_rate = $data->tax_rate;
	
	// $subGroupId=$_REQUEST['subGroupId'];
	// $matureTypeId=$_REQUEST['matureTypeId'];
	// $effectiveDateAd = $_REQUEST['effectiveDateAd'];
	// $effectiveDateBs = $_REQUEST['effectiveDateBs'];
	// $rate = $_REQUEST['rate'];
	// $tax_rate = $_REQUEST['tax_rate'];

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
	$query = sprintf("INSERT INTO groupintrate (subGroupId, matureTypeId,effectedDateBs, effectedDateAd,rate,tax_rate) values ('%d','%d','%s','%s','%s','%s')",
		$conn->real_escape_string($subGroupId),
		$conn->real_escape_string($matureTypeId),
		$conn->real_escape_string($effectiveDateBs),
		$conn->real_escape_string($effectiveDateAd),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($tax_rate)
	);
	//echo "<br>".$query;
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"groupsavingintrates" => array(
			"id" => mysqli_insert_id($conn),
			"subGroupId" => $subGroupId,
			"matureTypeId" => $matureTypeId,
			"effectedDateBs"=>$effectiveDateBs,
			"effectedDateAd"=>$effectiveDateAd,
			"rate"=>$rate,
			"tax_rate"=>$tax_rate,
			"matureType" =>$periodDesc,
			"subGroupDesc"=>$subGroupDesc,
			"subGroupCode"=>$subGroupCode
		)
	));
?>