<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//mysql_query("SET NAMES utf8");  
	$info = $_POST['chequeprints'];

	$data = json_decode($info);
	$id = $data->id;
	$accountNo=$data->accountNo;
	$accountDesc = $data->accountDesc;
	$startNo = $data->startNo;
	$endNo = $data->endNo;
	$noofLeaf = (int)$data->endNo- (int)$data->startNo+1;
	$printedBy=$data->printedBy;
	$printedDateBs=$data->printedDateBs;
	$printedDateAd=$data->printedDateAd;
	
	$rs = $conn->query("select userName from user where id='".$printedBy."'");
	$userName = null;
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$userName = $r['userName'];
	}

	//consulta sql
	$query = sprintf("UPDATE chequeprint SET startNo = '%s', endNo='%s', noofLeaf='%d', printedBy = '%d', printedDateAd='%s' WHERE id=%d",
		$conn->real_escape_string($startNo),
		$conn->real_escape_string($endNo),
		$noofLeaf,
		$conn->real_escape_string($printedBy),
		$printedDateAd,
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	$delSql ="delete from chequeissued where chequeBundleId='$id'";
	$conn->query($delSql);

	for($i= (int)$startNo; $i<=(int)$endNo; $i++){
		$sql ="insert into chequeissued(chequeBundleId, accountNo, chequeNo, issuedDateBs, issuedDateAd, issuedBy) values('".$id."','".$accountNo."','".$i."','".$printedDateBs."','".$printedDateAd."','".$printedBy."')";
		$conn->query($sql);
	}


	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"chequeprints" => array(
		"id" => $id,
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