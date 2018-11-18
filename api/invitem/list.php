<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];


	$queryString = "SELECT i.*,g.group_code as parent_group, u.ShortName as unit from inv_item i left join inv_group g on i.group_id = g.id left join unit u on i.unit_id = u.id left join department dpt on dpt.id = i.department_id LIMIT $start,  $limit";

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
		"invitems" => $data
	));
?>