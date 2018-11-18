<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$accountNo = $_REQUEST['accountNo'];
	$fiscalYear =$_REQUEST['fiscalYear'];
	$sourceCodeId =$_REQUEST['sourceCodeId'];
	$entryNo =$_REQUEST['entryNo'];
	$balance =0;
	$sql ="select * from acmaster where accountNo='".$accountNo."'";
	$rs = $conn->query($sql);
	$r = mysqli_fetch_assoc($rs);
	$acnature = $r['natureId'];

	$sql ="select sum(debit) as dbt, sum(credit) as crd from tmpentry where accountNo ='".$accountNo."' and not(fiscalYear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."')";
	//consulta sql
	// $sql;
	$rs = $conn->query($sql) or die(mysqli_connect_error());
	if (mysqli_num_rows($rs)>0){
		$r = mysqli_fetch_assoc($rs);
		$debitSum= $r['dbt'];
		$creditSum= $r['crd'];

		if(($acnature=='1') || ($acnature=='4')){
			$balance = $debitSum - $creditSum;
		}else{
			$balance =  $creditSum-$debitSum;
		}
	}else{
		$balance =0;
	}

	

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"balance" => $balance
	));
?>