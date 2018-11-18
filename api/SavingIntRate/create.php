<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['savingintrates'];

	$data = json_decode($info);
	
	$accountNo = $data->accountNo;
	//$effectiveDateAd = date("Y-m-d",strtotime($data->effectiveDateAd));
	$effectiveDateAd = $data->effectiveDateAd;
	$effectiveDateBs=$data->effectiveDateBs;
	$rate=$data->rate;
	
	$rs = $conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$r= mysqli_fetch_assoc($rs);
	$accountDesc = $r['accountDesc']; 
	$address = $r['address'];
	//consulta sql
	$query = sprintf("INSERT INTO saving_int_rate (accountNo,effectiveDateAd,effectiveDateBs, rate) values ('%s','%s','%s','%s')",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($effectiveDateAd),
		$conn->real_escape_string($effectiveDateBs),
		$conn->real_escape_string($rate)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"savingintrates" => array(
			"id" => mysqli_insert_id($conn),
			"accountNo" => $accountNo,
			"effectiveDateAd" => $effectiveDateAd,
			"effectiveDateBs"=>$effectiveDateBs,
			"rate"=>$rate,
			"accountDesc"=> $accountDesc,
			"address"=>$address
		)
	));
?>