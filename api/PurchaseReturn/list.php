<?php
	include("../../includes/conectar.php");
	$fiscalYear = $_REQUEST['fiscalYear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];

	$sql="select p.*, invItm.item_name as itemName,invItm.alias_name as alias_name, u.ShortName as unitName from stock p left join inv_item invItm on p.itemId = invItm.id left join unit u on p.unitId = u.id where p.fiscalYear='$fiscalYear' and p.sourceCodeId = '$sourceCodeId' and p.entryNo='$entryNo' and p.qty_out>0";
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
		"purchasereturn" => $data,
		"totalAmount"=>$totalAmount,
		"sql"=>$sql
	));


?>