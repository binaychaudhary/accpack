<?php
	include("../../includes/conectar.php");
	$qry="select * from transactiondate order by tranDateAd desc limit 1";
	$rs = $conn->query($qry);
	$fnd = false;
	$state="not opened";
	if(mysqli_num_rows($rs)>0){
		$fnd=true;
	}
	if($fnd){
		$r=mysqli_fetch_assoc($rs);
		$lstTranDtAd= $r['tranDateAd'];
		if($r['closed']){
			$state=1;
		}else{
			$state=0;
		}
	}else{
		date_default_timezone_set('Asia/Kathmandu');
		$lstTranDtAd= date('Y/m/d');
	}

	echo json_encode(array(
		"found" => $fnd,
		"lstTranDtAd" => $lstTranDtAd,
		"state"=>$state
	));
?>