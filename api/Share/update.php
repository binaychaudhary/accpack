<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['sharepurchases'];

	$data = json_decode($info);
	$id = $data->id;
	$accountNo=$data->accountNo;
	$share_kitta = $data->share_kitta;
	$purchase_date=$data->purchase_date;

	$rs=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$r=mysqli_fetch_assoc($rs);
	$accountDesc=$r['accountDesc'];

	//consulta sql
	$query = sprintf("UPDATE sharepurchase SET share_kitta = '%d',purchase_date = '%s' WHERE id=%d",
		$conn->real_escape_string($share_kitta),
		$conn->real_escape_string($purchase_date)
		$conn->real_escape_string($id));

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sharepurchases" => array(
			"id" => $id,
			"accountNo"=>$accountNo,
			"accountDesc" => $accountDesc,
			"share_kitta" => $share_kitta,
			"purchase_date"=>$purchase_date
		)
	));
?>