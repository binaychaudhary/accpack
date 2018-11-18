<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];

	$accountNo= $_REQUEST['accountNo'];
	$accountDesc = $_REQUEST['accountDesc'];
	$accountTypeId= $_REQUEST['accountTypeId'];
	$acCategory= $_REQUEST['acCategory'];
	$mature_type_id= $_REQUEST['mature_type_id'];
	$status = $_REQUEST['status'];

	$cr="";
	if(is_null($status)||($status=="")){
	}else{
		$cr=" where s.status = '".$status . "'";
	}
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where s.accountNo like '%".$accountNo . "%'";
		}else{
			$cr = $cr." and s.accountNo like '%".$accountNo . "%'";
		}
	}
	if(is_null($accountDesc)||($accountDesc=="")){
	}else{
		if($cr==""){
			$cr=" where a.accountDesc like '%".$accountDesc . "%'";
		}else{
			$cr = $cr." and a.accountDesc like '%".$accountDesc . "%'";
		}
	}
	if(is_null($acCategory)||($acCategory=="")){
	}else{
		if($cr==""){
			$cr=" where s.acCategory = '".$acCategory . "'";
		}else{
			$cr = $cr." and s.acCategory = '".$acCategory . "'";
		}
	}

	if(is_null($accountTypeId)||($accountTypeId=="")){
	}else{
		if($cr==""){
			$cr=" where s.accountTypeId = '".$accountTypeId . "'";
		}else{
			$cr = $cr." and s.accountTypeId = '".$accountTypeId . "'";
		}
	}

	if(is_null($mature_type_id)||($mature_type_id=="")){
	}else{
		if($cr==""){
			$cr=" where s.mature_type_id = '".$mature_type_id . "'";
		}else{
			$cr = $cr." and s.mature_type_id = '".$mature_type_id . "'";
		}
	}

	$queryString = "SELECT s.*, a.accountDesc, mp.periodDesc, ac.acCategory, h.hw from savingacdetail s left join acmaster a on s.accountNo=a.accountNo left join matureperiod mp on s.mature_type_id = mp.id left join accategory ac on s.acCategoryId = ac.id left join hw h on s.hw_id = h.id ".$cr." LIMIT $start,  $limit";

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
		"savingdetails" => $data
	));
?>