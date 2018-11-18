<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$status=$_REQUEST['status'];
	$role=$_REQUEST['role'];
	$cr="";
	//echo "<br>".$name_np;
	if(is_null($role)||($role=="")){
	}else{
		$cr=" where role like '".$role . "%'";
	}
	if(is_null($status)){
	}else{
		if($cr==""){
			$cr=" where status like '".$status . "%'";
		}else{
			$cr = $cr." and status like '".$status . "%'";
		}
	}
	//echo "<br>".$cr;
	$queryString = "SELECT * FROM role ".$cr." LIMIT $start,  $limit";
	//echo "<br>".$queryString."<br>";
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$roles = array();
	while($role = mysqli_fetch_assoc($query)) {
	    $roles[] = $role;
	}

	//consulta total de linhas na tabela
	$queryTotal = $conn->query('SELECT count(*) as num FROM role'.$cr) or die(mysqli_connect_error());
	$row = mysqli_fetch_assoc($queryTotal);
	$total = $row['num'];

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $total,
		"roles" => $roles
	));
?>