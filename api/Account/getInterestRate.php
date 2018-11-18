<?php
	include("../../includes/conectar.php");
	$accountNo=$_REQUEST['accountNo'];
	$date_ad = $_REQUEST['date_ad'];

	$sql ="select * from saving_int_rate where accountNo='".$accountNo."' and effectiveDateAd<'".$date_ad."'";
	$rs=$conn->query($sql);
	if(mysqli_num_rows($rs)){
		$r= mysqli_fetch_assoc($rs);
		$rate= $r['rate'];
		$found=true;
	}else{
		$rate=0;
		$found=false;
	}
	echo json_encode(array(
		"found" => $found,
		"rate" => $rate;
		)
	));
?>