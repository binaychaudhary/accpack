<?php
	include("../../includes/conectar.php");
	$aliasName = $_REQUEST['aliasName'];

	$sql ="select i.*, ig.group_name,u.id as unitId, u.ShortName as unitName, su.ShortName as salesUnitName, dpt.department from inv_item i left join inv_group ig on i.group_id = ig.id left join unit u on i.unit_id = u.id left join unit su on i.salesUnitId = su.id left join department dpt on i.department_id = dpt.id where i.alias_name ='".$aliasName."'";

	$query = mysqli_query($conn,$sql) or die(mysqli_connect_error());

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
		"invitems" => $data
	));
	mysqli_close($conn);

?>