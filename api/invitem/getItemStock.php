<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemId = $_REQUEST['itemId'];
	$cr=$_REQUEST['cr'];
	$unitId = $_REQUEST['unitId'];
	
	$queryString="select * from  inv_item where id='".$itemId."'";
	$rs = $conn->query($queryString);
	$r=mysqli_fetch_assoc($rs);
	$unit_id = $r['unit_id'];
	$perUnit = $r['perUnit'];

	$stock=0;
	$purchase=0;
	$sales=0;
	$queryString ="select sum(qty_in) as purchase, sum(qty_out) as sales from stock where itemId='".$itemId."'".$cr;
	$rs = $conn->query($queryString);
	if(mysqli_num_rows($rs)){
		$r= mysqli_fetch_assoc($rs);
		if(!is_null($r['purchase'])){
			$purchase=$r['purchase'];	
		}
		if(!is_null($r['sales'])){
			$sales=$r['sales'];
		}		
		$stock=$purchase - $sales;
		if($unit_id!=$unitId){
			$stock = $stock * $perUnit;
		}
	}
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"stock" => $stock,
		"queryString"=>$queryString
	));
?>