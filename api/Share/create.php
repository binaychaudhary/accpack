<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['sharepurchases'];

	$data = json_decode($info);
	$accountNo=$data->accountNo;
	$share_kitta = $data->share_kitta;
	$purchase_date=$data->purchase_date;

	$rs=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$r=mysqli_fetch_assoc($rs);
	$accountDesc=$r['accountDesc'];

	//consulta sql
	$query = sprintf("INSERT INTO sharepurchase (accountNo, share_kitta, purchase_date) values ('%s','%d','%s')",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($share_kitta),
		$conn->real_escape_string($purchase_date)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sharepurchases" => array(
			"id" => mysqli_insert_id($conn),
			"accountNo"=>$accountNo,
			"accountDesc" => $accountDesc,
			"share_kitta" => $share_kitta,
			"purchase_date"=>$purchase_date
		)
	));
?>