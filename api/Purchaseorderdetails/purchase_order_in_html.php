<?php

	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$order_no = $_REQUEST['order_no'];

	$sql ="select * from org";
	$rs = $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$orgName=$r['orgName'];
	$address=$r['address'];
	$email = $r['email'];

	
	$sql="select * from purchase_order where id='".$order_no."'";
	$rs=$conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$order_date_bs = $r['order_date_bs'];
	$ordered_to = $r['ordered_to'];
	$email_address = $r['email_address'];

	$rs=$conn->query("select * from acmaster where id='".$ordered_to."'");
	$r=mysqli_fetch_assoc($rs);
	$ordered_to_desc=$r['accountDesc'];


	$sql ="select pod.*, itm.alias_name, itm.item_name, u.Unit from purchase_order_detail pod left join inv_item itm on pod.item_id = itm.id left join unit u on pod.unit_id = u.id where pod.order_id='".$order_no."' order by pod.id";

	$rs = $conn->query($sql);


	$ml="<!DOCTYPE html>
	<html>
	<head>
		<title>Purchase Order</title>
	</head>
	<body>
		<div width='100%' align='center'><b>".$orgName."<br>".$address."<br>Email:".$email."</b><br><br></div>";


		$ml.="<table width='100%'><tr><td width='70%'>Order No: ".$order_no."<td><td width='30%'>Order Date: ".$order_date_bs."</td></tr><tr><td>Supplier Name: ".$ordered_to_desc."<td><td>Suppler Email: ".$email_address."</td></tr><table><br>";
		$ml.="<table width='100%' border='1'><tr align='center'><td>SN</td><td>Code</td><td>Description</td><td>Unit</td><td>Qty</td><td>Rate</td><td>Amount</td></tr>";
		$sn=0;
		$totalAmount=0;
		while($r=mysqli_fetch_assoc($rs)){
			$sn=$sn+1;
			$totalAmount = $totalAmount + $r['amount'];
			$ml.="<tr><td align='center'>".$sn."</td><td>".$r['alias_name']."</td><td>".$r['item_name']."</td><td>".$r['Unit']."</td><td align='right'>".$r['qty']."</td><td align='right'".$r['rate']."</td><td align='right'>".$r['amount']."</td></tr>";			
		}

		$ml.="<tr><td></td><td></td><td></td><td></td><td></td><td align='right'>Total =></td><td align='right'><b>".$totalAmount."</b></td></tr>";	

		$ml.="</table>
	</body>
	</html>";
echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"emailContent" => $ml
	));

?>