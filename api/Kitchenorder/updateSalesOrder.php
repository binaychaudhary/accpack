<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$entry_date_bs = $_REQUEST['entry_date_bs'];
	$locationId  = $_REQUEST['locationId'];
	$kot_id  = $_REQUEST['kot_id'];

	$qry="update kitchen_order set status ='0' where entry_date_bs = '$entry_date_bs' and locationId ='$locationId' and status='1'";	
	$conn->query($qry);

	$qry="update kot set status='0' where id='$kot_id'";
	$conn->query($qry);
?>