<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['chequeprints'];

	$data = json_decode($info);
	$accountNo=$data->accountNo;
	$accountDesc = $data->accountDesc;
	$startNo = $data->startNo;
	$endNo = $data->endNo;
	$noofLeaf = (int)$data->endNo- (int)$data->startNo+1;
	$printedDateBs=$data->printedDateBs;
	$printedDateAd=$data->printedDateAd;
	$printedBy=$data->printedBy;
	
	
	$rs = $conn->query("select userName from user where id='".$printedBy."'");
	$r=mysqli_fetch_assoc($rs);
	$userName = null;
	if(mysqli_num_rows($rs)>0){
		$userName = $r['userName'];
	}
	

	//consulta sql
	$query = sprintf("INSERT INTO chequeprint (accountNo, startNo, endNo, noofLeaf, printedDateBs, printedDateAd, printedBy) values ('%s','%s','%s','%d','%s','%s','%d')",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($startNo),
		$conn->real_escape_string($endNo),
		$noofLeaf,
		$conn->real_escape_string($printedDateBs),
		$conn->real_escape_string($printedDateAd),
		$conn->real_escape_string($printedBy)
	);

	$rs = $conn->query($query);
	$chequeBundleId = mysqli_insert_id($conn);
	for($i= (int)$startNo; $i<=(int)$endNo; $i++){
		$sql ="insert into chequeissued(chequeBundleId, accountNo, chequeNo, issuedDateBs, issuedDateAd, issuedBy) values('".$chequeBundleId."','".$accountNo."','".$i."','".$printedDateBs."','".$printedDateAd."','".$printedBy."')";
		$conn->query($sql);
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"chequeprints" => array(
			"id" => $chequeBundleId,
			"accountNo" => $accountNo,
			"accountDesc" => $accountDesc,
			"startNo"=>$startNo,
			"endNo"=>$endNo,
			"noofLeaf"=>$noofLeaf,
			"printedDateBs"=>$printedDateBs,
			"printedBy"=> $printedBy,
			"userName"=>$userName
		)
	));
?>