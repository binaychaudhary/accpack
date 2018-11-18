<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$yr = $_REQUEST['yr'];
	$mn = $_REQUEST['mn'];
	$accountNo = $_REQUEST['accountNo'];
	$consumer_name = $_REQUEST['consumer_name'];
	$meter_no = $_REQUEST['meter_no'];


	$cr="";
	
	if(is_null($yr)||($yr=="")){
	}else{
		if($cr==""){
			$cr=" where mb.yr = '".$yr . "'";
		}else{
			$cr = $cr." and mb.yr = '".$yr . "'";
		}
	}

	if(is_null($mn)||($mn=="")){
	}else{
		if($cr==""){
			$cr=" where mb.mn = '".$mn . "'";
		}else{
			$cr = $cr." and mb.mn = '".$mn . "'";
		}
	}

	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where mb.accountNo like '".$accountNo . "%'";
		}else{
			$cr = $cr." and mb.accountNo like '".$accountNo . "%'";
		}
	}
	if(is_null($meter_no)||($meter_no=="")){
	}else{
		if($cr==""){
			$cr=" where mb.meter_id like '".$meter_no . "%'";
		}else{
			$cr = $cr." and mb.meter_id like '".$meter_no . "%'";
		}
	}
	if(is_null($consumer_name)||($consumer_name=="")){
	}else{
		if($cr==""){
			$cr=" where c.consumer_name like '".$consumer_name . "%'";
		}else{
			$cr = $cr." and c.consumer_name like '".$consumer_name . "%'";
		}
	}

	$queryString = "SELECT mb.*, c.consumer_name from monthlybill mb left join consumer c on mb.consumer_id = c.id".$cr;

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
		"monthlybilling" => $data
	));
?>       