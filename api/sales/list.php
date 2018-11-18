<?php
	include("../../includes/conectar.php");
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];

	$sql="select s.*, invItm.item_name as itemName,invItm.alias_name as alias_name, u.ShortName as unitName from stock s left join inv_item invItm on s.itemId = invItm.id left join unit u on s.unitId = u.id where s.fiscalYear='$fiscalYear' and s.sourceCodeId = '$sourceCodeId' and s.entryNo='$entryNo'";
	//echo $sql;

	$query = $conn->query($sql) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$cnt=0;
	$totalAmount=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	    $totalAmount=$totalAmount + $dat['amount'];
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"sales" => $data,
		"totalAmount"=>$totalAmount,
		"qry" =>$sql
	));
?>