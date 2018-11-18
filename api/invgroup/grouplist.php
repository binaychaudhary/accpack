<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");


	$queryString = "SELECT ig.*, p.group_name as parent_group from inv_group ig left join inv_group p on ig.parent_group_id=p.id where ig.level>0 and ig.hasChild=0 order by ig.id";

	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
		if($dat['hasChild']){
			$sql="select count(*) as cnt from inv_group where parent_group_id='".$dat['id']."'";	
			$rsN=$conn->query($sql);
			$r= mysqli_fetch_assoc($rsN);	
			$cont = $r['cnt'];
		}else{
			$cont=0;
		}
		//echo($sql);


		$dat['count']=$cont;
	    $data[] = $dat;
	}
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"invlastgroup" => $data
	));
?>