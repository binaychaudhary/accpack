<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$collectorId = $_REQUEST['collectorId'];
	$fiscalYear =$_REQUEST['fiscalYear'];
	$monthId =$_REQUEST['monthId'];
	$subGroupId=$_REQUEST['subGroupId'];
	$balance =0;
	$cr ="";
	if(is_null($collectorId)||($collectorId=="")){
	}else{
		$cr = " where collectorId='".$collectorId."'";
	}
	//echo $cr."<br>";
	if(is_null($fiscalYear)||($fiscalYear=="")){
	}else{
		$cr = $cr . " and fiscalyear ='".$fiscalYear."'";
	}
	//echo $cr."<br>";
	
	if(is_null($monthId)||($monthId=="")){
	}else{
		$cr = $cr . " and mid(entry_date_bs,6,2) ='".$monthId."'";
	}
	//echo $cr."<br>";
	
	if(is_null($subGroupId)||($subGroupId=="")){
	}else{
		$cr = $cr . " and subGroupCode ='".$subGroupId."'";
	}
	$cr = $cr ." and credit>0";
	//echo $cr."<br>";
	
	$sql ="select sum(credit) as collection from tmpentry".$cr;
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$r = mysqli_fetch_assoc($rs);
		$collection = $r['collection'];	
	}else{
		$collection=0;
	}
	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"collection" => $collection
	));
?>