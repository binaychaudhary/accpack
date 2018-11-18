<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$userId = $_REQUEST['userId'];
	$mainMenuId = $_REQUEST['mainMenuId'];

	$cr="";
	if(is_null($userId)||($userId=="")){
	}else{
		$cr=" where mu.userId = '".$userId . "'";
	}
	if(is_null($mainMenuId)){
	}else{
		if($cr==""){
			$cr=" where mu.mainmenuId = '".$mainMenuId . "'";
		}else{
			$cr = $cr." and mu.mainmenuId = '".$mainMenuId . "'";
		}
	}

	$queryString = "SELECT mu.*, mm.menuName as mainMenuName, sm.menuName as menuName from menutousers mu left join mainmenu mm on mu.mainMenuId= mm.id left join submenu sm on mu.menuId = sm.id".$cr;

	//echo "<br>".$queryString;
	//consulta sql
	$rs = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}

	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"menutousers" => $data,
		"query" => $queryString
	));
?>