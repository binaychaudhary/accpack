<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$kot_id = $_REQUEST['kot_id'];
	$locationId = $_REQUEST['locationId'];
	$entry_date_bs = $_REQUEST['entry_date_bs'];
	$status = $_REQUEST['status'];

	$cr =null;
	if($entry_date_bs != ""){
		$cr = " where o.entry_date_bs like '".$entry_date_bs."%'";
	}

	if($kot_id != ""){
		if(is_null($cr) || ($cr=="")){
			$cr = " where o.kot_id='".$kot_id."'";
		}else{
			$cr = $cr." and o.kot_id='".$kot_id."'";
		}	
	}
	if($locationId != ""){
		if(is_null($cr) || ($cr=="")){
			$cr = " where o.locationId='".$locationId."'";
		}else{
			$cr = $cr." and o.locationId='".$locationId."'";
		}	
	}
	if($status !=""){
		if(is_null($cr) || ($cr=="")){
			$cr = " where o.status='".$status."'";
		}else{
			$cr = $cr." and o.status='".$status."'";
		}	
	}

	$queryString = "SELECT o.*, l.location_name, i.item_name as itemName,i.alias_name, u.ShortName as unit, st.staffName as waiter_name from kitchen_order o left join location l on o.locationId=l.id left join inv_item i on o.itemId = i.id left join unit u on i.unit_id = u.id left join staff st on o.waiter_id = st.id ".$cr;

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}
	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"kitchenorders" => $data,
		"qry"=>$queryString
	));
?>