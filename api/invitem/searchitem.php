<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$itemName = $_REQUEST['itemName'];
	$aliasName = $_REQUEST['aliasName'];
	$groupId = $_REQUEST['groupId'];
	$groupName=$_REQUEST['groupName'];	
	$formName = $_REQUEST['formName'];
	$effective_date_ad = $_REQUEST['effective_date_ad'];
	$department_id = $_REQUEST['department_id'];
	$searchCriteria= $_REQUEST['searchCriteria'];

	$cr="";
	if(is_null($itemName)||($itemName=="")){
	}else{
		if($cr==""){
			$cr=" where i.item_name like '%".$itemName . "%'";
		}else{
			$cr = $cr." and i.item_name like '%".$itemName . "%'";
		}
	}

	if(is_null($aliasName)||($aliasName=="")){
	}else{
		if($cr==""){
			$cr=" where i.alias_name like '%".$aliasName . "%'";
		}else{
			$cr = $cr." and i.alias_name like '%".$aliasName . "%'";
		}
	}
	if(is_null($groupId)||($groupId=="")){
	}else{
		if($cr==""){
			$cr=" where i.group_id = '".$groupId. "'";
		}else{
			$cr = $cr." and i.group_id = '".$groupId. "'";
		}
	}
	if(is_null($groupName)||($groupName=="")){
	}else{
		if($cr==""){
			$cr=" where g.group_name = '".$groupName . "'";
		}else{
			$cr = $cr." and g.group_name = '".$groupName . "'";
		}
	}
	if(is_null($department_id)||($department_id=="")){
	}else{
		if($cr==""){
			$cr=" where i.department_id = '".$department_id . "'";
		}else{
			$cr = $cr." and i.department_id = '".$department_id . "'";
		}
	}

	if(is_null($searchCriteria)||($searchCriteria=="")){
	}else{
		if($cr==""){
			$cr=" where ".$searchCriteria;
		}else{
			$cr = $cr." and ".$searchCriteria;
		}
	}

	if($formName=="sales") {
		$queryString = "SELECT i.*, g.group_code, u.ShortName as unit, (select p.purchase_rate from inv_item_put_rate p where p.itemId = i.id and p.effective_date_ad<='".$effective_date_ad."' order by p.effective_date_ad desc limit 1) as purchase_rate, (select s.sales_rate from inv_item_rate s where s.itemId = i.id and s.effective_date_ad<='".$effective_date_ad."' order by s.effective_date_ad desc limit 1) as sales_rate from inv_item i left join inv_group g on i.group_id = g.id left join unit u on i.salesUnitId = u.id left join department dpt on i.department_id = dpt.id left join inv_item_rate rt on rt.itemId=i.id ".$cr;	
	}elseif($formName=="sales_order"){
		$queryString = "SELECT i.*, g.group_code, u.ShortName as unit, rt.sales_rate from inv_item i left join inv_group g on i.group_id = g.id left join unit u on i.salesUnitId = u.id left join department dpt on i.department_id = dpt.id left join inv_item_rate rt on rt.itemId=i.id".$cr;	
	}else{
		$queryString = "SELECT i.*, g.group_code, u.ShortName as unit, (select p.purchase_rate from inv_item_put_rate p where p.itemId = i.id order by id desc limit 1) as purchase_rate, (select s.sales_rate from inv_item_rate s where s.itemId = i.id order by id desc limit 1) as sales_rate  from inv_item i left join inv_group g on i.group_id = g.id left join unit u on i.unit_id = u.id left join department dpt on i.department_id = dpt.id left join inv_item_rate rt on rt.itemId=i.id".$cr;
	}
	

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

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
		"invitems" => $data,
		"query" => $queryString
	));
?>