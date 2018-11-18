<?php
	include("../../includes/conectar.php");


	$sql ="select * from consumer order by id";
	$rs = $conn->query($sql);

	while ($r = mysqli_fetch_assoc($rs)){
		$accountNo = $r['accountNo'];
		$consumer_name = $r['consumer_name'];
		$contactNo = $r['contactNo'];
		$meter_no =$r['meter_no'];

		$prvId = $r['id']-2;
		$upd="update acmaster set accountDesc='".$consumer_name."', contactNo = '$contactNo' where accountNo='".$accountNo."'";
		$conn->query($upd);
	}	
	echo "finished";
?>