<?php
	//chama o arquivo de conexão com o bd
	include("conectar.php");
	$queryString = $_REQUEST['queryString'];
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	if(mysqli_num_rows($query)>0){
		$fnd=1;
	}else{
		$fnd=0;
	}


	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"found"=>$fnd
	));
?>