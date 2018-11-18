<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$uid = $_REQUEST['uid'];
	$newpass = md5($_REQUEST['newpass']);
	
	$queryString = "UPDATE  user  SET pass='$newpass' WHERE id='$uid'";
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//encoda para formato JSON
	echo json_encode(array(
		"response" =>mysqli_connect_errno() == 0

	));
?>