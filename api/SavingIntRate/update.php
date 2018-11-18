<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['savingintrates'];

	$data = json_decode($info);
	$id=$data->id;
	$accountNo = $data->accountNo;
	//$effectiveDateAd =date("Y-m-d",strtotime($data->effectiveDateAd));
	$effectiveDateAd =$data->effectiveDateAd;
	$effectiveDateBs=$data->effectiveDateBs;
	$rate=$data->rate;
	// $id=$_REQUEST['id'];
	// $accountNo = $_REQUEST['accountNo'];
	// $effectiveDateAd = date("Y-m-d",strtotime($_REQUEST['effectiveDateAd']));
	// $effectiveDateBs=$_REQUEST['effectiveDateBs'];
	// $rate=$_REQUEST['rate'];
	// echo "Effective Date Ad : ".$effectiveDateAd;
	$rs = $conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$r= mysqli_fetch_assoc($rs);
	$accountDesc = $r['accountDesc']; 
	$address = $r['address'];
	//consulta sql
	$query = sprintf("UPDATE saving_int_rate SET accountNo = '%s', effectiveDateAd = '%s', effectiveDateBs='%s', rate='%s' WHERE id=%d",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($effectiveDateAd),
		$conn->real_escape_string($effectiveDateBs),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($id)
	);
	// echo "<br>".$query;
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"savingintrates" => array(
			"id" => $id,
			"accountNo" => $accountNo,
			"effectiveDateAd" => $effectiveDateAd,
			"effectiveDateBs"=>$effectiveDateBs,
			"rate"=>$rate,
			"accountDesc"=> $accountDesc,
			"address"=>$address
		)
	));
?>