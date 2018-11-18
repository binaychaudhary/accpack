<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['monthlybilling'];

	// $data = json_decode($info);
	$fiscalyear = $_REQUEST['fiscalyear'];
	$yr = $_REQUEST['yr'];
	$mn = $_REQUEST['mn'];
	$entry_date_bs=$_REQUEST['entry_date_bs'];
	$entry_date_ad=$_REQUEST['entry_date_ad'];
	$prv_reading=$_REQUEST['prv_reading'];
	$cur_reading = $_REQUEST['cur_reading'];
	$unit = $_REQUEST['unit'];
	$rate_id = $_REQUEST['rate_id'];
	$amount = $_REQUEST['amount'];
	$consumer_id = $_REQUEST['consumer_id'];
	$meter_id = $_REQUEST['meter_id'];
	$accountNo = $_REQUEST['accountNo'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$entryNo = $_REQUEST['entryNo'];
	$id = $_REQUEST['id'];
	
	//consulta sql
	if($id==""){

		$query = sprintf("INSERT INTO monthlybill (fiscalyear,yr, mn, entry_date_bs, entry_date_ad, prv_reading, cur_reading,unit, rate_id, amount, consumer_id, meter_id, accountNo, sourceCodeId, entryNo) values ('%s', '%d','%d','%s','%s','%s','%s', '%s', '%d', '%s', '%d', '%s', '%s', '%d', '%s')",
			$conn->real_escape_string($fiscalyear),
			$conn->real_escape_string($yr),
			$conn->real_escape_string($mn),
			$conn->real_escape_string($entry_date_bs),
			$conn->real_escape_string($entry_date_ad),
			$conn->real_escape_string($prv_reading),
			$conn->real_escape_string($cur_reading),
			$conn->real_escape_string($unit),
			$conn->real_escape_string($rate_id),
			$conn->real_escape_string($amount),
			$conn->real_escape_string($consumer_id),
			$conn->real_escape_string($meter_id),
			$conn->real_escape_string($accountNo),
			$conn->real_escape_string($sourceCodeId),
			$conn->real_escape_string($entryNo)
		);
		$rs = $conn->query($query);
		$id=mysqli_insert_id($conn);
	}else{
		$query="update monthlybill set prv_reading='$prv_reading', cur_reading='$cur_reading', unit='$unit', amount='$amount' where id='$id'";
		$rs = $conn->query($query);
	}

	
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"qr" => $query,
		"monthlybilling" => array(
			"id" => $id,
			"yr" => $yr,
			"mn" => $mn,
			"entry_date_bs"=>$entry_date_bs,
			"entry_date_ad" => $entry_date_ad,
			"prv_reading"=>$prv_reading,
			"cur_reading"=>$cur_reading,
			"unit" =>$unit,
			"rate_id" =>$rate_id,
			"amount" =>$amount,
			"consumer_id" =>$consumer_id,
			"meter_id" =>$meter_id,
			"accountNo" =>$accountNo,
			"sourceCodeId" =>$sourceCodeId,
			"entryNo" =>$entryNo
		)
	));
?>