<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$uid = $_REQUEST['uid'];
	
	$queryString = "SELECT *  FROM user WHERE id=$uid";
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$dat = mysqli_fetch_assoc($query);
	
	//encoda para formato JSON
	echo json_encode(array(
		"response" =>$dat

	));
?>